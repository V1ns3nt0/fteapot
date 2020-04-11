<template>
  <button type="button" v-on:click="addToCart">Купить</button>
</template>

<script>
    export default {
    props: ['product'],
        data() {
          return {
            productItem: this.product,
            cart:[],
            curPr: null,
            cart1: [],
          }
        },
        // mounted() {
        //     console.log('component is loaded')
        //     if (localStorage.getItem('cart')) {
        // 			try {
        // 				this.cart = JSON.parse(localStorage.getItem('cart'));
        // 			} catch(e) {
        //         		localStorage.removeItem('cart');
        //       }
        // 		}
        // },
        methods: {
          containsObject(obj, arr) {
              let i;
              for (i = 0; i < arr.length; i++) {
                  if (arr[i].productId === obj.id) {
                      return i;
                  }
              }
              return -1;
          },
          // saveCart() {
      		// 	let parsed = JSON.stringify(this.cart);
      		// 	localStorage.setItem('cart', parsed);
      		// },
          addToCart() {
            this.curPr = this.containsObject(this.productItem, this.$root.cart);

          if(this.curPr >= 0) {
            console.log(this.curPr);
            // this.cart1 = this.cart.map(
            //   p => p.id !== this.curPr ? {id: p.id, productId: p.productId, path:p.path,
            //    name: p.name, price:p.price,
            //    quantity: p.quantity, itemsPrice:p.itemsPrice} : {id: p.id, productId: p.productId, path:p.path,
            //    name: p.name, price:p.price,
            //    quantity: p.quantity + 1, itemsPrice:p.itemsPrice+p.price}
            // );
            this.$root.cart[this.curPr] = {id: this.$root.cart[this.curPr].id, productId: this.$root.cart[this.curPr].productId, path:this.$root.cart[this.curPr].path,
            name: this.$root.cart[this.curPr].name, price:this.$root.cart[this.curPr].price,
            quantity: this.$root.cart[this.curPr].quantity + 1, itemsPrice:this.$root.cart[this.curPr].itemsPrice+this.$root.cart[this.curPr].price};
            console.log(this.cart[this.curPr]);
            // this.saveCart();
          } else {

            console.log(this.productItem);
            this.$root.cart.push({id: this.$root.cart.length, productId: this.productItem.id, path:this.productItem.path,
             name: this.productItem.name, price:this.productItem.price, quantity: 1,
             itemsPrice:1*this.productItem.price});
             // this.saveCart();
             this.$root.saveCart();
          }
          this.$root.saveCart();
            //
            // console.log(this.productItem);

          }
        }
    }
</script>
