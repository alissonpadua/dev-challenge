<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Novo Produto</h2>
      <hr>
      <b-form>
        <b-row>
          <b-col cols="12" md="3">
            <b-form-group
              label="Categoria"
              label-for="category">
                <b-form-select v-model="product.category" :options="categoriesFiltered"></b-form-select>
                <p v-if="backEndErros.category" class="text-danger">{{ backEndErros.category[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="6">
            <b-form-group
              label="Descrição"
              label-for="description">
              <b-form-input
                v-model="product.description"
                id="description"
                type="text"
                required></b-form-input>
                <p v-if="backEndErros.description" class="text-danger">{{ backEndErros.description[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="2">
            <b-form-group
              label="Preço"
              label-for="price">
                <money class="form-control" v-model="product.price" v-bind="money"></money>
                <p v-if="backEndErros.price" class="text-danger">{{ backEndErros.price[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="6" class="text-right">
            <b-button variant="success" v-on:click="create">Confirmar</b-button>
          </b-col>
        </b-row>
      </b-form>
    </b-card>
  </div>
</template>
<script>
import ProductAPI from './../../api/ProductAPI'
import CategoryAPI from './../../api/CategoryAPI'
import { Money } from 'v-money'

export default {
  components: { Money },
  data () {
    return {
      isAdding: false,
      backEndErros: '',
      categories: [],
      product: {
        category: '',
        description: '',
        price: ''
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
      this.backEndErros = ''
      this.isAdding = true
      ProductAPI.create(this.product).then((response) => {

        this.$snotify.success(response.data.message);
        this.isAdding = false
        this.$router.push({ path: '/seller/product/list' })

      }).catch((error) => {

        if(error.response) {
          this.backEndErros = error.response.data.errors
        }
        this.isAdding = false

      })
    },
    getCategories () {
      CategoryAPI.all().then((response) => {
        this.categories = response.data.data
      })
    }
  },
  computed: {
    categoriesFiltered () {
      let localData = []
      this.categories.filter((item) => {
        localData.push({value: item.id, text: item.description})
      })
      return localData
    }
  },
  created () {
    this.getCategories()
  }
}
</script>
  