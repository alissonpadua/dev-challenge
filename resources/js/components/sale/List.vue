<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Vendas</h2>
      <hr>
      <b-link v-on:click="createSale" class="p-3">NOVA VENDA</b-link>
      <b-table class="mt-3"
        striped hover responsive
        :items="salesTable.items"
        :fields="salesTable.fields">
          <template slot="controls" slot-scope="row">
            <b-button variant="link" class="text-primary" v-on:click="getProducts(row.item.id)">
             <b>Produtos</b>
            </b-button>
          </template>
      </b-table>
      <p class="text-center p-4" v-if="sales.length == 0"><b>Nenhuma Vendas foi efetivada</b></p>
    </b-card>

    <b-modal title="Produtos" ref="myProducts" ok-only size="lg">
      <b-table
        striped hover responsive
        :items="productsTable.items"
        :fields="productsTable.fields">
      </b-table>
    </b-modal>

  </div>
</template>

<script>
import SaleAPI from './../../api/SaleAPI'

export default {
  data () {
    return {
      sales: [],
      salesTable: {
        fields: [
          { key: "id", label: "#" },
          { key: "client", label: "Cliente" },
          { key: "paymode", label: "Método de Pagamento" },
          { key: "totalSale", label: "Total" },
          { key: "createAt", label: "Data" },
          { key: "controls", label: "" }
        ],
        items: []
      },
      products: [],
      productsTable: {
        fields: [
          { key: "id", label: "#" },
          { key: "description", label: "Descrição" },
          { key: "price", label: "Preço" },
          { key: "qty", label: "Quantidade" }
        ],
        items: []
      },
    }
  },
  methods: {
    createSale () {
      this.$router.push({ path: '/seller/sale/create' })
    },
    getSales () {
      SaleAPI.all().then((response) => {
        this.sales = response.data.data
        let localData = []
        this.sales.filter((item) => {
          localData.push({
            id: item.id,
            client: item.client.name,
            paymode: item.paymode.description,
            totalSale: item.totalSale,
            createAt: item.created_at
          })
        })
        this.salesTable.items = localData
      })
    },
    getProducts (id) {
      this.products = []
      SaleAPI.findProductsBySale(id).then((response) => {
        this.products = response.data.data
        let localData = []
        this.products.filter((item) => {
          localData.push({
            id: item.id,
            description: item.description,
            price: item.price,
            qty: item.qty
          })
        })
        this.productsTable.items = localData
        this.$refs.myProducts.show()
      })
    }
  },
  created () {
    this.getSales()
  }
}
</script>
