<template>
  <div>
    <b-card-group deck>
      <b-card class="text-center" bg-variant="dark">
        <h4>Hoje</h4>
        <hr>
        <h1>{{ day }}</h1>
        <hr>
        <h4>Vendas</h4>
      </b-card>
      <b-card class="text-center" bg-variant="primary">
        <h4>Mês</h4>
        <hr>
        <h1>{{ month }}</h1>
        <hr>
        <h4>Vendas</h4>
      </b-card>
      <b-card class="text-center" bg-variant="success">
        <h4>Total</h4>
        <hr>
        <h1>{{ total }}</h1>
        <hr>
        <h4>Vendas</h4>
      </b-card>
    </b-card-group>
  </div>
</template>
<script>
import DashboardAPI from './../../api/DashboardAPI'

export default {
  data () {
    return {
      total: 0,
      month: 0,
      day: 0
    }
  },
  methods: {
    getSales () {
      DashboardAPI.sales().then((response) => {
        this.total = response.data.data.totalSales
        this.month = response.data.data.salesMonth
        this.day = response.data.data.salesToday
      })
    }
  },
  created () {
    this.getSales()
  }
}
</script>