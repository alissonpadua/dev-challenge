<template>
  <div class="animated fadeIn">
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
            <p v-if="backEndErros.client" class="text-danger">{{ backEndErros.client[0] }}</p>
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
            <p v-if="backEndErros.paymode" class="text-danger">{{ backEndErros.paymode[0] }}</p>
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
      <b-row class="row">
        <b-col>
          <b-table class="mt-3"
            responsive
            condensed
            :items="productsTable.items"
            :fields="productsTable.fields">
            <template slot="price" slot-scope="row">
              <money class="inputOnTable form-control"
                disabled
                v-bind="money"
                v-model="selected.products[row.index].price">
              </money>
            </template>
            <template slot="totalLine" slot-scope="row">
              <money class="inputOnTable form-control"
                disabled
                v-bind="money"
                v-model="productsTable.items[row.index].totalLine">
              </money>
            </template>
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
            <template slot="controls" slot-scope="row">
              <b-button variant="link" class="text-danger" v-on:click="removeProduct($event, row.index)">
                <i class="fa fa-trash-o fa-2x"></i>
              </b-button>
            </template>
          </b-table>
          <p class="text-center p-4" v-if="selected.products.length == 0"><b>Nenhum Produto foi adicionado</b></p>
          <p v-if="backEndErros.products" class="text-danger text-center">{{ backEndErros.products[0] }}</p>
        </b-col>
      </b-row>
      <b-row class="text-center">
        <b-col size="12" md="12">
          <hr>
          <b-form inline class="pull-right">
            <label class="mr-sm-2" for="totalTable">
              <b>TOTAL</b>
            </label>
            <money id="totalTable" class="form-control mb-2 mr-sm-2 mb-sm-0"
              disabled
              v-bind="money"
              v-bind:value="totalSale">
            </money>
          </b-form>
        </b-col>
      </b-row>
    </b-card>
    <b-card>
      <b-row>
        <b-col size="12" md="12" class="text-center">
          <ul>
            <li class="text-danger" v-for="(error, index) in formattedErros" v-bind:key="index">
              Erro na Linha {{ index + 1 }}: {{ error }}
            </li>
          </ul>
        </b-col>
      </b-row>
      <b-row>
        <b-col size="12" md="12" class="text-center">
          <b-button variant="success" v-on:click="create">Confirmar Venda</b-button>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
import ClientAPI from './../../api/ClientAPI'
import PaymodeAPI from './../../api/PaymodeAPI'
import ProductAPI from './../../api/ProductAPI'
import SaleAPI from './../../api/SaleAPI'
import { Money } from 'v-money'

export default {
  components: { Money },
  data () {
    return {
      backEndErros: [],
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
      },
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'R$ ',
        precision: 2,
        masked: false
      }
    }
  },
  methods: {
    create () {
      this.backEndErros = []
      SaleAPI.create(this.selected).then((response) => {
        this.$snotify.success(response.data.message);
      }).catch((error) => {
        if(error.response) {
          if( error.response.data.errors) {
            this.backEndErros = error.response.data.errors
          } else {
            this.$snotify.error(error.response.data.message);
          }
        }
      })
    },
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
    removeProduct (e, index) {
      this.selected.products.splice(index, 1)
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
  computed: {
    totalSale () {
      let totalSale = 0 
      this.productsTable.items.filter((item) => {
        totalSale += item.totalLine
      })
      return totalSale
    },
    formattedErros () {
      let errors = []
      Object.entries(this.backEndErros).forEach(([key, value]) => {
        if(key.includes('products.')) {
          errors.push(value[0])
        }
      })
      return errors
    },
  },
  created () {
    this.getClients()
    this.getPaymodes()
    this.getProducts()
  }
}
</script>

<style>
  .inputOnTable {
    min-width: 10em !important;
  }
</style>
