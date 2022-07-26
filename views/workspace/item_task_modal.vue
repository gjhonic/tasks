<script type="text/x-template" id="item-task-template">
  <div slot="header">Editing</div>

  <div slot="body" class="tm-grid tm-grid-large" style="width: 400px">
    <div class="tm-width-1-1">
      <h5>2132</h5>
    </div>
  </div>
  <div slot="footer" class="tm-flex tm-flex-right">
    <button class="tm-btn " @click="showModalItemTask=false">Cancel</button>
  </div>
</script>

<script>
Vue.component("modal-item-task", {
  template: "#item-task-template",
  data() {
    return {
    };
  },
  computed: {},
  methods: {
    open() {
      console.log('123');
    },
    save() {
      console.log('Мы сохранили');
      /*let body = {
        rating_bgi_id: this.rating_bgi_id,
        plan_day: this.plan_day,
        fact_day: this.fact_day,
      };
      let url =
          "/index.php?module=Rating_BGI&action=save";
      fetch(url, {
        method: "POST",
        body: JSON.stringify(body),
      })
          .then((response) => response.json())
          .then((data) => {
            console.log(data);
            if (data.error === true) {
              Notify.showError(data.message);
            } else {
              Notify.showSuccess(data.message);
              this.$emit("saved");
              this.showModalItemTask = false;
            }
            BaseTemplate.hideProgress();
          });*/
    },
  },
});
</script>
