<template>
  <tr>
      <th scope="row">
          <img :src=" productItem.path " alt="lunczin" class="img-fluid z-depth-0">
      </th>
      <td class="align-middle">
          <h5 class="mt-3">
              <strong>{{ productItem.name }}</strong>
          </h5>
      </td>
      <td></td>
      <td class="align-middle">{{ productItem.price }}&#x20bd;</td>
      <td class="align-middle">
        <div class="d-flex">
            <button type="button" class="btn btn-green btn-sm" v-on:click="decreaseQuantity">-</button>
          {{ productItem.quantity }}
            <button type="button" class="btn btn-green btn-sm" v-on:click="increaseQuantity">+</button>
        </div>
      </td>
      <td class="font-weight-bold align-middle">
          <strong>{{ productItem.itemsPrice }}&#x20bd;</strong>
      </td>
      <td class="align-middle">
          <button type="button" class="btn-light-green btn btn-sm greenlight-BG"
              data-toggle="tooltip" data-placement="top" title="Remove item"
              v-on:click="removeItem">X
          </button>
      </td>
  </tr>
</template>

<script>
  export default {
    props: ['product', 'index'],
    data() {
      return {
        productItem: this.product,
        cart:this.$root.cart,
        curPr: null,
      }
    },
    methods: {
      decreaseQuantity() {
        console.log(this.index);
        if(this.$root.cart[this.index].quantity > 1) {
          this.$root.cart[this.index].quantity -= 1;
          this.$root.cart[this.index].itemsPrice -= this.productItem.price;
          this.$root.saveCart();
          this.$root.sumPrice();
        } else {
          this.removeItem();
        }

      },
      increaseQuantity() {
        console.log(this.$vnode.key);
        this.$root.cart[this.index].quantity += 1;
        this.$root.cart[this.index].itemsPrice += this.productItem.price;
        this.$root.saveCart();
        this.$root.sumPrice();
      },
      removeItem() {
        console.log(this.$vnode.key);
        // let ind = this.$root.cart.indexOf(this.productItem);
        // if (ind > -1) {
        //   this.$root.cart.splice(ind, 1);
        // }
        this.$root.cart.splice(this.index, 1);
        // this.$delete(this.$root.cart ,this.$vnode.key)
        this.$root.saveCart();
        this.$root.sumPrice();
      }
    }
  }
</script>
