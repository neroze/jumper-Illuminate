var Search = {};
Search.seach_now = function() {
    // let _from = moment(this.dateRange.from, 'YYYY-MM-DD').format('DD/MM/YYYY');
    this.filterBy = "";
    this.filterBy = "date_range";
}

Search.reset_search = function(e) {
    e.preventDefault();
    this.filterBy = "";
    this.serach_date_range = null;
}

// filter methods
Search.filter_by_date = function(searchCollection) {
    if (this.filterBy == '' || this.filterBy == null) {
        return searchCollection;
    }

    return searchCollection.filter((order) => {
        var order_date = moment().format('YYYY-MM-DD')
        if (this.filterBy == 'today') {
            if (moment(order.created_at).format('YYYY-MM-DD') == order_date)
                return true;
        } else if (this.filterBy == 'week') {
            if (order.created_at >= moment().startOf('week').format('YYYY-MM-DD') && order.created_at <= moment().endOf('week').format('YYYY-MM-DD'))
                return true;

        } else if (this.filterBy == 'month') {
            if (order.created_at >= moment().startOf('month').format('YYYY-MM-DD') && order.created_at <= moment().endOf('month').format('YYYY-MM-DD'))
                return true;

        } else if (this.filterBy == 'last-month') {
            if (order.created_at >= moment().add(1, 'months').startOf('month').format('YYYY-MM-DD') && order.created_at <= moment().add(1, 'months').endOf('month').format('YYYY-MM-DD'))
                return true;
        } else if (this.filterBy == 'date_range') {
            if (moment(order.created_at).format('YYYY-MM-DD') >= this.dateRange.from && moment(order.created_at).format('YYYY-MM-DD') <= this.dateRange.to) {
                return true;
            }
        }

        return false;
    });
}

Search.setSearchParam = function(_obj) {
    this.dateRange.from = _obj.from;
    this.dateRange.to = _obj.to;
    this.filterBy = _obj.filterBy;
    if (this.filterBy != '' && this.filterBy != null){
        this.seach_now();
    }else{
        this.filterBy = "";
        this.filterBy = _obj.filterBy;
    }
}

module.exports = Search;