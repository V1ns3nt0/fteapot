/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// window.Vue.use(require('vue-cookies'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

function containsObject(obj, arr) {
    let i;
    for (i = 0; i < arr.length; i++) {
        if (arr[i].productId === obj.productId) {
            return true;
        }
    }

    return false;
}

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('cart-item', require('./components/cartItem.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
      name: null,
      path: '',
      price: 0,
      generalPrice:0,
      quantity:1,
      cart: [],
    },
    mounted() {
  		if (localStorage.getItem('cart')) {
  			try {
  				this.cart = JSON.parse(localStorage.getItem('cart'));
  			} catch(e) {
          		localStorage.removeItem('cart');
        }
        this.sumPrice();
  		}
      // this.name = window.name;
      // this.path = window.path;
      // this.price = window.price;
  	},
    methods: {
      saveCart: function() {
  			let parsed = JSON.stringify(this.cart);
  			localStorage.setItem('cart', parsed);
  		},
      itemsToCookie: function() {
        this.sumPrice();
        document.cookie = "cart=" + JSON.stringify(this.cart);
        document.cookie = "sumPrice=" + JSON.stringify(this.price);
      },
      sumPrice: function() {
        this.price = 0;
        this.cart.forEach(item => {
          this.price += item.itemsPrice;
        });
      },
      // addToCart: function(id) {
      //   // this.cart.push({id: this.cart.length, productId: id, path:'iii',
      //   //   name: this.name, price:this.price, quantity: this.quantity,
      //   //   itemsPrice:this.quantity*this.price});
      //   // this.saveCart();
      //   console.log(this.name);
      // },
      // demo: function(){
      //   console.log(this.quote);
      // }
    }
});
