<template>
  <div class="animated fadeIn">
    <b-row class="mb-5">
      <b-col size="12" md="12">
        <SalesCards />
      </b-col>
    </b-row>
    <b-row>
      <b-col size="12" md="12">
        <b-card class="text-center">
          <h4>Vendas de Produtos</h4>
          <hr>
          <ProductsChart /> 
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import ProductsChart from './dashboard/ProductsChart'
import SalesCards from './dashboard/SalesCards'

export default {
  components: { ProductsChart, SalesCards },
  name: 'dashboard', 
}
</script>

<style>
canvas{
    margin: 0 auto;
    }
</style>

