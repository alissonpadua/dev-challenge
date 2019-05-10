<template>
  <div class="animated fadeIn">
    <b-form>
      <b-card>
        <b-row>
          <b-col size="12" md="12">
            <h2>Nova venda</h2>
            <hr>
          </b-col>
        </b-row>
        <b-row>
          <b-col size="12" md="6">
            <b-form-group
              label="Cliente"
              label-for="client">
              <b-form-select id="client"
                v-model="selected.client"
                :options="options.inputClient">
              </b-form-select>
            </b-form-group>
          </b-col>
          <b-col size="12" md="6">
            <b-form-group
              label="Método de Pagamento"
              label-for="paymode">
              <b-form-select id="paymode"
                v-model="selected.paymode"
                :options="options.inputPaymode">
              </b-form-select>
            </b-form-group>
          </b-col>
        </b-row>
      </b-card>
      <b-card>
        <b-row>
          <b-col size="12" md="12">
            <h2>Produtos</h2>
            <hr>
          </b-col>
        </b-row>
        <b-row>
          <b-col size="12" md="6">
              <b-input-group>
                <b-form-select v-model="options.selectedProduct" :options="options.inputProduct"></b-form-select>
                <b-input-group-append>
                  <b-button variant="primary"
                    v-on:click="addProduct"
                    v-bind:disabled="!options.selectedProduct">
                      Adicionar
                  </b-button>
                </b-input-group-append>
              </b-input-group>
          </b-col>
        </b-row>
        <b class="row">
          <b-col>
            <b-table class="mt-3"
              responsive
              :items="productsTable.items"
              :fields="productsTable.fields">
              <template slot="qty" slot-scope="row">
                <b-input-group>
                  <b-form-input type="text" class="col-md-4"
                    v-bind:value="selected.products[row.index].qty"
                    disabled>
                  </b-form-input>
                  <b-input-group-append>
                    <b-button variant="outline-dark" v-on:click="increment(row.index)">
                      <i class="icons d-block cui-chevron-top"></i>
                    </b-button>
                    <b-button variant="outline-dark" v-on:click="decrement(row.index)">
                      <i class="icons d-block cui-chevron-bottom"></i>
                    </b-button>
                  </b-input-group-append>
                </b-input-group>
              </template>
            </b-table>
          </b-col>
        </b>
      </b-card>
      <b-card>
        <b-row>
          <b-col size="12" md="12">
            <h2>Resumo</h2>
            <hr>
          </b-col>
        </b-row>
      </b-card>
    </b-form>
  </div>
</template>

<script>
import ClientAPI from './../../api/ClientAPI'
import PaymodeAPI from './../../api/PaymodeAPI'
import ProductAPI from './../../api/ProductAPI'

export default {
  data () {
    return {
      clients: [],
      paymodes: [],
      products: [],
      options: {
        inputClient: [],
        inputPaymode: [],
        inputProduct: [],
        selectedProduct: ''
      },
      selected: {
        client: '',
        paymode: '',
        products: []
      },
      productsTable: {
        fields: [
          { key: "id", label: "#" },
          { key: "description", label: "Descrição" },
          { key: "category", label: "Categoria" },
          { key: "price", label: "Preço" },
          { key: "qty", label: "Quantidade" },
          { key: "totalLine", label: "Total" },
          { key: "controls", label: "" }
        ],
        items: []
      }
    }
  },
  methods: {
    increment (index) {
      this.selected.products[index].qty += 1
      this.updateProductsTable()
    },
    decrement (index) {
      this.selected.products[index].qty -= 1
      if(this.selected.products[index].qty <= 1) {
        this.selected.products[index].qty = 1
      }
      this.updateProductsTable()
    },
    addProduct () {
      let index = this.products.findIndex(
        item => item.id == this.options.selectedProduct
      )
      let productToInsert = this.products[index]
      productToInsert.qty = 1

      let verifyIndex = this.selected.products.findIndex(
        item => item.id == productToInsert.id
      )

      if(verifyIndex == -1) {
        this.selected.products.push(productToInsert)
      }

      this.updateProductsTable()
     
    },
    updateProductsTable () {
      let localData = []
      this.selected.products.filter((item) => {
        localData.push({
          id: item.id,
          description: item.description,
          category: item.category.description,
          price: item.price,
          qty: item.qty,
          totalLine: item.price * item.qty
        })
      })
      this.productsTable.items = localData
    },
    getClients () {
      ClientAPI.all().then((response) => {
        this.clients = response.data.data
        let localData = []
        this.clients.filter((item) => {
          localData.push({
            value: item.id,
            text: item.name
          })
        })
        this.options.inputClient = localData
      })
    },
    getPaymodes () {
      PaymodeAPI.all().then((response) => {
        this.paymodes = response.data.data
        let localData = []
        this.paymodes.filter((item) => {
          localData.push({
            value: item.id,
            text: item.description
          })
        })
        this.options.inputPaymode = localData
      })
    },
    getProducts () {
      ProductAPI.all().then((response) => {
        this.products = response.data.data
        let localData = []
        this.products.filter((item) => {
          localData.push({
            value: item.id,
            text: item.description
          })
        })
        this.options.inputProduct = localData
      })
    }
  },
  created () {
    this.getClients()
    this.getPaymodes()
    this.getProducts()
  }
}
</script>
