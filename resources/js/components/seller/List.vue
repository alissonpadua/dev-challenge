<template>
  <div class="animated fadeIn">
    <b-card>
      <h2>Vendedores</h2>
      <hr>
      <b-link v-on:click="createSeller" class="p-3">NOVO VENDEDOR</b-link>
      <b-table class="mt-3"
        :busy="isBusy"
        striped hover responsive
        :items="sellersTable.items"
        :fields="sellersTable.fields">
        <template slot="controls" slot-scope="row">
          <b-dropdown id="dropdown-1" variant="primary">
            <template slot="button-content"><i class="cui-wrench icons font-2xl"></i></template>
            <b-dropdown-item v-on:click="editSeller($event, row.item.id)">Editar</b-dropdown-item>
            <b-dropdown-item v-on:click="deleteSeller($event, row.item.id)">Deletar</b-dropdown-item>
          </b-dropdown>
        </template>
      </b-table>
      <p class="text-center p-4" v-if="sellers.length == 0"><b>Nenhum Vendedor Cadastrado</b></p>
    </b-card>
  </div>
</template>

<script>
import SellerAPI from './../../api/SellerAPI'

export default {
  name: 'seller-list',
  data () {
    return {
      isBusy: false,
      sellers: [],
      sellersTable: {
        fields: [
          { key: "id", label: "#" },
          { key: "name", label: "Nome" },
          { key: "email", label: "E-mail" },
          { key: "controls", label: "" }
        ],
        items: []
      }
    }
  },
  methods: {
    createSeller () {
      this.$router.push({ path: '/seller/user/create' })
    },
    editSeller (e, id) {
      this.$router.push({ path: '/seller/user/edit/' + id })
    },
    deleteSeller (e, id) {
      this.$snotify.confirm('Tem certeza que deseja Deletar este Vendedor?', 'Confirmação', {
        position: 'centerTop',
        buttons: [
          {
            text: 'Sim',
            action: (toast) => {
              this.$snotify.remove(toast.id)
              this.isBusy = true
              SellerAPI.delete(id).then((response) => {
                let rsp = response.data.data
                this.$snotify.success(response.data.message);
                this.getSellers()
              }).catch((error) => {
                this.$snotify.error('Falha ao deletar Vendedor, atualize a página e tente novamente');
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
    getSellers () {
      this.isBusy = true
      SellerAPI.all().then((response) => {
        this.sellers = response.data.data
        let localData = []
        this.sellers.filter((item) => {
          localData.push({
            id: item.id,
            name: item.name,
            email: item.email
          })
        })
        this.sellersTable.items = localData
        this.isBusy = false
      })
    }
  },
   created () {
    this.getSellers()
  }
}
</script>

<style>
  table.b-table[aria-busy='true'] {
    opacity: 0.3;
    pointer-events: none;
  }
</style>

