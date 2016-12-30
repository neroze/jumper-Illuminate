var DatePicker = {
    template: `
             <div >
            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
            <input name="{{name}}" type="text" id="{{name}}"  v-model="dateField" 
            class="form-control col-md-7 col-xs-12 dob cal_cal asyc-dob {{name}}">
            <small class="green">dd/mm/yyyy</small>
          </div>
    `,
    data: function() {
        return {
            dateField: null
        }
    },
    props: ['name','init_data'],
    methods: {

    },
    ready: function() {
        let _init_data = this.init_data || moment().format('DD/MM/YYYY');
        $('#'+this.name).daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_2",
            startDate:_init_data,
            locale: {
                        format: 'DD/MM/YYYY'
                    }
        }, (start) => {
            // deprecated disptach style method
            // this.$dispatch('date-picked', {
            //     name:this.name,
            //     date: start.format('DD/MM/YYYY')
            // });
            this.init_data = start.format('DD/MM/YYYY');
        });
    }
}


module.exports = DatePicker;