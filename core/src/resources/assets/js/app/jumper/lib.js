var Vue = require('Vue');
// var J = require('../jumper/lib.js');
var vueResource = require('vue-resource');
    Vue.use(vueResource);
var _ = require('lodash');
var Base = require('./Base.js');
var randomcolor = require('randomcolor');
var Jumper = {};
Jumper = Object.assign(Object.create(Base), Jumper);

Jumper.log = function(_msg ){
	console.log(_msg);
}
Jumper.random_color = function(_luminosity, _hue) {
	var luminosity 	= luminosity || "dark";
	var hue 				= _hue || "blue";
  
	return randomcolor({
									   luminosity: luminosity,
   										hue: hue
										});
}

Jumper.random_color_dump = function(){
	return ('#'+Math.floor(Math.random()*16777215).toString(16));
}

Jumper.delete_file_from_server = function(_filename){

  $.ajax({
    url: '/admin/delete-file',
    type: 'GET',
    dataType: 'json',
    data: {file: _filename},
  })
  .done(function() {
    Jumper.log(resp);
  },(error) => {
      
  });
}

Jumper.set_data_table = function(_table) {

    var asInitVals = new Array();
    $('input.tableflat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    var oTable = $(_table).dataTable({
      // ajax:'/admin/role',
      "oLanguage": {
        "sSearch": "Search all columns:"
      },
      "aoColumnDefs": [{
          'bSortable': false,
          'aTargets': [0]
        } //disables sorting for column one
      ],
      'iDisplayLength': 12,
      "sPaginationType": "full_numbers",

    });
    $("tfoot input").keyup(function() {
      /* Filter on the column based on the index of this element's parent <th> */
      oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
    });
    $("tfoot input").each(function(i) {
      asInitVals[i] = this.value;
    });
    $("tfoot input").focus(function() {
      if (this.className == "search_init") {
        this.className = "";
        this.value = "";
      }
    });
    $("tfoot input").blur(function(i) {
      if (this.value == "") {
        this.className = "search_init";
        this.value = asInitVals[$("tfoot input").index(this)];
      }
    });
}

Jumper.time_diff = function(_from, _to){
  var now  = moment().format("MM/DD/YYYY")+" "+moment(_from, ["h:mm A"]).format("HH:mm");
  var then = moment().format("MM/DD/YYYY")+" "+moment(_to, ["h:mm A"]).format("HH:mm");
  var diff = moment.duration(moment(then).diff(moment(now)));
  return moment.utc(diff.asMilliseconds()).format("HH:mm");
}

Jumper.alert = function(_opt){

  var opt = {
      title:"Notification",
      text:"",
      type:"dark"
  }
  opt = _.extend(opt, _opt);
  
  new PNotify({
                title: opt.title,
                text: opt.text,
                type:opt.type
            });
}

window.jalert = function(_msg){
  Jumper.alert({text:_msg});
}


window.redAlert = function(_msg){
  Jumper.alert({type:"danger",text:_msg});
}

Jumper.reset = function(_obj){
  _.filter(_obj, function(val, key){
     _obj[key] = null ;
  });
  return _obj;
}


Jumper.scrollTO = function(_to){
  $('html, body').animate({
      scrollTop: $(_to).offset().top
  }, 1000);
}

Jumper.open_all_panel = function(){
  $('.panel-collapse').collapse('hide');
  setTimeout(function() {
    $('.panel-collapse').collapse('show');
    $('.panel-collapse').collapse('show');
    $('.panel-title').attr('data-toggle', '');
    $('.panel-title').attr('data-toggle', '');
  }, 450);
  
}

Jumper.show_loading_button = function(target){
  var self = this;
  $(target).button('loading');
  // setTimeout(function() {
  //     $(target).button('loading');
  // },1210); 
}

Jumper.reset_loading_button = function(target){
  $(target).button('reset');
}

// short name function for show_loading_button and reset_loading_button
Jumper.btn_loading = function(target){
  this.show_loading_button(target)
}

Jumper.btn_reset = function(target){
  this.reset_loading_button(target)
}


Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
//Jumper.Vue  = Vue;
Jumper = Object.assign(Jumper,{Vue});
Jumper._  = _;


// Jumper Vue filers
Jumper.Vue.filter('show_role', function (_id) {
    var _role = null
    var _role_meta = window.role_meta;

    if(!_.isNaN(_role_meta) && !_.isEmpty(_role_meta)){
      _role = _.find(_role_meta, {'id': parseInt(_id) });
      if(!_.isEmpty(_role)){
        return _role.display_name;
      }
    }
});

Jumper.Vue.filter('byRole', function (_users) {
    var _role = location.hash.replace("#","");
    if(_role == ""){
      return _users;
    }
    return _.filter(_users, function(user){ 
       return  _.find( user.roles , {name:_role});
       
    });
});

Jumper.Vue.filter('show_only_if_educator', function (_user) {
    return _.find(_user.roles , {name:'educator'}) ? true : false;
});

Jumper.Vue.filter('ISODate', function (value) {
    return value;
});

Jumper.Vue.filter('show_gender_title', function (_gender) {
    return _gender?"Male":"Female";
});

Jumper.Vue.filter('show_country_flag', function (_name) {
    return "https://lipis.github.io/flag-icon-css/flags/4x3/"+_name.toLocaleLowerCase()+".svg";
});

Jumper.Vue.filter('MMM_Do_YYYY', function (_date) {
  //2016-09-20 11:02:07
    return  moment(_date, 'YYYY-M-D hh:mm:ss').format('Do MMM YYYY');
});

Jumper.Vue.filter('dd/mm/yyyy', function (_date) {
  //2016-09-20 11:02:07
    return  moment(_date, 'YYYY-M-D hh:mm:ss').format('DD/MM/YYYY');
});

Jumper.Vue.filter('weekDay', function (value) {
    console.log('weekday:'+value);
    var _weekDay = 'Sunday';
    switch(value){
      case 1:
        _weekDay = "Sunday";
        break;
      case 2:
        _weekDay = "Monday";
        break;
      case 3:
        _weekDay = "Tuesday";
        break;
      case 4:
        _weekDay = "Wednesday";
        break;
      case 5:
        _weekDay = "Thursday";
        break;
      case 6:
        _weekDay = "Friday";
        break;
      case 7:
        _weekDay = "Saturday";
        break;
    }

    return _weekDay;

});
module.exports = Jumper;