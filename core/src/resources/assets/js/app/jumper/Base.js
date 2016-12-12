let Base = {
  dev: {
  	author: 'Jumper',
  	email:'neerooze@gmail.com',
  	github:'https://github.com/neroze'
  },
  describe :function() {
    return `An Awesome person with good sense of humor... :). ${this.dev.author}, emial: ${this.dev.email}, github : ${this.dev.github}`;
  },
  init(){
  	console.log("Developed By : "+this.dev.author+"\n"+"http://nirajmaharjan.com.np");
  }
};
Base.init();
module.exports = Base;