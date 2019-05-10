<script>
import { Doughnut } from 'vue-chartjs'
import DashboardAPI from './../../api/DashboardAPI'

export default {
  extends: Doughnut,
  data () {
    return {
      labels: [],
      data: [],
      colors: [],
    }
  },
  methods: {
    getSales () {
      this.resetData()
      DashboardAPI.products().then((response) => {
        response.data.data.filter((item) => {
          this.labels.push(item.description)
          this.data.push(item.total)
          this.colors.push('#'+(Math.random()*0xFFFFFF<<0).toString(16))
        })
            this.renderChart({
      labels: this.labels,
      datasets: [
        {
          backgroundColor: this.colors,
          data: this.data
        }
      ]
    }, {responsive: true, maintainAspectRatio: false})
      })
    },
    resetData () {
      this.labels = []
      this.data = []
      this.colors = []
    }
  },
  mounted () {
    this.getSales()
  }

}
</script>

