<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Vendas</h2>
      <hr>
      <b-link v-on:click="createSale" class="p-3">NOVA VENDA</b-link>
    </b-card>
  </div>
</template>

<script>
export default {
  methods: {
    createSale () {
      this.$router.push({ path: '/seller/sale/create' })
    }
  }
}
</script>
