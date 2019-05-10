<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Editar Vendedor</h2>
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
                type="password"></b-form-input>
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
                type="password"></b-form-input>
                <p v-if="backEndErros.password_confirmation" class="text-danger">{{ backEndErros.password_confirmation[0] }}</p>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" md="6" class="text-right">
            <b-button variant="success" v-on:click="update">Atualizar Informações</b-button>
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
        id: this.$route.params.id,
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    getSeller () {
      if(!this.seller.id) {
        this.$snotify.error('Vendedor não encontrato')
        this.$router.push({ path: '/seller/user/list' })
      } else {
        SellerAPI.find(this.seller.id).then((response) => {
          let rsp = response.data.data
          this.seller = {
            id: rsp.id,
            name: rsp.name,
            email: rsp.email
          }
          this.isLoading = false
        }).catch((error) => {
          this.$snotify.error('Falha ao buscar Vendedor, atualize a página e tente novamente');
          this.$router.push({ path: '/seller/user/list' })
        })
      }
    },
    update () {
      this.backEndErros = ''
      this.isAdding = true
      SellerAPI.update(this.seller).then((response) => {

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
  },
  created () {
    this.getSeller()
  }
}
</script>
  