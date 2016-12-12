var J = require('../jumper/lib.js');
J.Vue.component('star-rating', {template: ' <div class="star-rating col-md-2"> ' +
    '<label class="star-rating__star" v-for="rating in ratings" :class="{ \'is-selected \' : ((value >= rating) && value != null), \'is-disabled\': disabled}" v-on:mouseover="star_over(rating)" v-on:mouseout="star_out" v-on:click.prevent="set(rating)">' +
    '<input class="star-rating star-rating__checkbox" type="radio" v-model="value">★</label>' +
    '<style>' +
    '.star-rating .star-rating__star {' +
    'display: inline-block;' +
    'padding: 3px;' +
    'vertical-align: middle; ' +
    'line-height: 1; ' +
    'font-size: 1.5em;' +
    'color: #ABABAB;' +
    'transition: color .2s ease-out;' +
    'cursor: pointer;' +
    '}' +
    '.star-rating input[type="radio"]{ ' +
    'display: none; ' +
    '}' +
    '.star-rating .star-rating__star.is-selected {' +
    'color: #FFD700;' +
    '} ' +
    '</style>' +
    '</div>',
    props: ['value', 'max', 'disabled'],
    computed : {
      ratings : function(){
          if(!this.max) { return [1, 2, 3, 4, 5]; }

          var numberArray = [];

          for(var i = 1; this.max >= i; i++){
              numberArray.push(i);
          }
          return numberArray;
      }
    },
    methods: {
        star_over: function (index) {
            if (this.disabled) {
                return;
            }

            this.temp_value = this.value;
            this.value = index;
        },
        star_out: function () {
            if (this.disabled) {
                return;
            }

            this.value = this.temp_value;
        },
        set: function (value) {
            if (this.disabled) {
                return;
            }

            this.temp_value = value;
            this.value = value;
            $("#star_rating").val(this.value);
        },
        get:function(){
          return this.value;
        }
    }
});

// var star_rating = new J.Vue({
//   el: '#rating_wrapper',
//   data : {
//   	writeModel : {
//     	first_rating : 4,
//       second_rating : 9,
//       third_rating : 3
//     }
//   }
// });

module.exports = star_rating;