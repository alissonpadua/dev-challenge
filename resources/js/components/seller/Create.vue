<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Novo Vendedor</h2>
      <hr>
      <b-form>
        <b-row>
          <b-col cols="12" md="6">
            <b-form-group
              label="Nome"
              label-for="name">
              <b-form-input
                v-model="seller.name"
                id="name"
                type="text"
                required></b-form-input>
                <p v-if="backEndErros.name" class="text-danger">{{ backEndErros.name[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="6">
            <b-form-group
              label="E-mail"
              label-for="email">
              <b-form-input
                v-model="seller.email"
                id="email"
                type="text"
                required></b-form-input>
                <p v-if="backEndErros.email" class="text-danger">{{ backEndErros.email[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="6">
            <b-form-group
              label="Senha"
              label-for="password">
              <b-form-input
                v-model="seller.password"
                id="password"
                type="password"
                required></b-form-input>
                <p v-if="backEndErros.password" class="text-danger">{{ backEndErros.password[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="6">
            <b-form-group
              label="Confirmação"
              label-for="password_confirmation">
              <b-form-input
                v-model="seller.password_confirmation"
                id="password_confirmation"
                type="password"
                required></b-form-input>
                <p v-if="backEndErros.password_confirmation" class="text-danger">{{ backEndErros.password_confirmation[0] }}</p>
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
import SellerAPI from './../../api/SellerAPI'

export default {
  data () {
    return {
      isAdding: false,
      backEndErros: '',
      seller: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    create () {
      this.backEndErros = ''
      this.isAdding = true
      SellerAPI.create(this.seller).then((response) => {

        this.$snotify.success(response.data.message);
        this.isAdding = false
        this.$router.push({ path: '/seller/user/list' })

      }).catch((error) => {

        if(error.response) {
          this.backEndErros = error.response.data.errors
        }
        this.isAdding = false

      })
    }
  }
}
</script>
  