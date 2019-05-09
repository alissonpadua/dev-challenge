<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Produtos</h2>
      <hr>
      <b-link v-on:click="createProduct" class="p-3">NOVO PRODUTO</b-link>
      <b-table class="mt-3"
        :busy="isBusy"
        striped hover responsive
        :items="productsTable.items"
        :fields="productsTable.fields">
        <template slot="controls" slot-scope="row">
          <b-dropdown id="dropdown-1" variant="primary">
            <template slot="button-content"><i class="cui-wrench icons font-2xl"></i></template>
            <b-dropdown-item v-on:click="editProduct($event, row.item.id)">Editar</b-dropdown-item>
            <b-dropdown-item v-on:click="deleteProduct($event, row.item.id)">Deletar</b-dropdown-item>
          </b-dropdown>
        </template>
      </b-table>
      <p class="text-center p-4" v-if="products.length == 0"><b>Nenhum Produto Cadastrado</b></p>
    </b-card>
  </div>
</template>

<script>
import ProductAPI from './../../api/ProductAPI'

export default {
  name: 'product-list',
  data () {
    return {
      isBusy: false,
      products: [],
      productsTable: {
        fields: [
          { key: "id", label: "#" },
          { key: "description", label: "Descrição" },
          { key: "category", label: "Categoria" },
          { key: "price", label: "Preço" },
          { key: "controls", label: "" }
        ],
        items: []
      }
    }
  },
  methods: {
    createProduct () {
      this.$router.push({ path: '/seller/product/create' })
    },
    editProduct (e, id) {
      this.$router.push({ path: '/seller/product/edit/' + id })
    },
    deleteProduct (e, id) {
      this.$snotify.confirm('Tem certeza que deseja Deletar este Produto?', 'Confirmação', {
        position: 'centerTop',
        buttons: [
          {
            text: 'Sim',
            action: (toast) => {
              this.$snotify.remove(toast.id)
              this.isBusy = true
              ProductAPI.delete(id).then((response) => {
                let rsp = response.data.data
                this.$snotify.success(response.data.message);
                this.getProducts()
              }).catch((error) => {
                this.$snotify.error('Falha ao deletar Produto, atualize a página e tente novamente');
                this.isBusy = false
              })
            },
            bold: true
          },
          {
            text: 'Não, fechar',
            action: (toast) => {
              this.$snotify.remove(toast.id)
            }
          }
        ]
      })
    },
    getProducts () {
      this.isBusy = true
      ProductAPI.all().then((response) => {
        this.products = response.data.data
        let localData = []
        this.products.filter((item) => {
          localData.push({
            id: item.id,
            description: item.description,
            category: item.category.description,
            price: item.price
          })
        })
        this.productsTable.items = localData
        this.isBusy = false
      })
    }
  },
   created () {
    this.getProducts()
  }
}
</script>

<style>
  table.b-table[aria-busy='true'] {
    opacity: 0.3;
    pointer-events: none;
  }
</style>

