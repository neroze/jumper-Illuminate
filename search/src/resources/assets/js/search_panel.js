var SearchPanel = {
        props: ['set_search_param'],
        data:function(){
          return {
            serach_date_range:"",
            filterBy:null,
            dateRange:{
              from:null,
              to:null,
              filterBy:null
            }
          }
        }
        ,methods:{
          seach_now:function(){
            this.set_search_param(this.dateRange);
          }
          ,set_date_range_picker:function() {
              $('.range_picker').daterangepicker({
                  singleDatePicker: false,
                  timePicker: false,
                  autoUpdateInput: true,
                  autoApply: true,
                  locale: {
                      format: 'YYYY-MM-DD'
                  }
              }, (start, end, label) => {
                  this.dateRange.from = moment(start.toISOString()).format('YYYY-MM-DD');
                  this.dateRange.to = moment(end.toISOString()).format('YYYY-MM-DD');
                  this.serach_date_range = moment(this.dateRange.from, 'YYYY-MM-DD').format('DD/MM/YYYY') + " - " + moment(this.dateRange.to, 'YYYY-MM-DD').format('DD/MM/YYYY');
                  this.dateRange.filterBy = "date_range";
              });
          },
          filterBychange:function(){
            this.set_search_param({from:null,to:null,filterBy:this.filterBy});
          },
          reset_search:function(){
            this.set_search_param({from:null,to:null,filterBy:""});
          }

        }
        ,mounted: function() {
          this.set_date_range_picker();
        }
        ,template: `<div class="row filters">
                      <div class="col-md-11">
                          <div class="col-md-7 col-sm-7 col-xs-12 form-group text-right">
                            <a class="pull-right btn label label-info " href="#" @click="reset_search($event)">Reset</a>
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                              <input type="text" class="form-control range_picker" v-model="serach_date_range" placeholder="Filter by Date"> 
                              <span class="input-group-btn">
                                <button class="btn btn-default"  type="button" @click="seach_now($event)">Search Now</button>
                              </span>
                            </div>
                          </div>    
                      </div>
                      <div class="col-md-1">
                            <div class="pull-right">
                              <select id="filter-by-date" class="form-control" @change="filterBychange" v-model="filterBy">
                                <option value="">All</option>
                                <option value="today">Today</option>
                                <option value="week">Last 7 Days</option>
                                <option value="month">This Month</option>
                                <option value="last-month">Last Month</option>
                              </select>
                            </div>  
                      </div>  
                    </div> `
    }
    
    module.exports = SearchPanel;