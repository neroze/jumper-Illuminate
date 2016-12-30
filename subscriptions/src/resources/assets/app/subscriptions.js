var J = require('../jumper/lib.js');
var Search = require('../search/search.js');
var SearchPanel = require('../search/search_panel.js');

var Subscription = {};

Subscription.init = function() {
    setTimeout(() => {
        J.set_data_table('#orders');
       // this.set_date_range_picker();
    }, 1000);
}

Subscription.get_all_orders = function() {
    var self = this;
    var url = '';
    if (location.hash == "") {
        url = base_url('all-orders');
    } else {
        url = base_url('all-orders') + location.hash.replace("#", "");
    }
    this.$http.get(url).then((resp) => {
        self.$set('orders', resp.data);
    }, (response) => {
        redAlert("Error while fetching Orders. Please reload the page and try again.")
    });
};

// extending search functions
Subscription = Object.assign(Subscription, Search);

new J.Vue({
    el: '#manage-orders',
    data: {
        orders: [],
        order: {
            name: null,
            user_id: null,
            customer_id: null,
            stipe_plan: null,
            subscription_ends_at: null,
            usermeta: [],
        },
        filterBy: "",
        dateRange: {},
        serach_date_range: null
    },
    mounted: function() {
        this.get_all_orders();
        this.init();
    },
    methods: Subscription,
    components:{
        'search-panel':SearchPanel
    }
});