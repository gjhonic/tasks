<script type="text/x-template" id="item-branch-template">
<transition name="modal-item-branch">
<div class="modal-mask">
  <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Adding a new branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="$emit('close')"></button>
      </div>

      <div class="modal-body">
        <slot name="body">
          <div class="mb-3">
            <label for="field-branch-name" class="col-form-label">Name</label>
            <input type="text" class="form-control" id="field-branch-name">
          </div>
          <div class="mb-3">
            <label for="field-branch-comment" class="col-form-label">Comments</label>
            <textarea class="form-control" id="field-branch-comment" style="height: 100px"></textarea>
          </div>
        </slot>
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" @click="$emit('close')">Close</button>
          <span class="hidden-elem">*</span>
          <button type="button" class="btn btn-outline-primary" @click="save()">Create task</button>
      </div>
    </div>
  </div>
</div>
</transition>
</script>

<script>
Vue.component("modal-item-branch", {
  template: "#item-branch-template",
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
      let name = $("#field-branch-name").val();
      let comment = $("#field-branch-comment").val();

      console.log([name, comment]);
      let body = {
        name: name,
        comment: comment,
      };
      let url = app.url_create_branch;

      fetch(url, {
        method: "POST",
        body: JSON.stringify(body),
      }).then((response) => response.json())
        .then((data) => {
          console.log(data);
        });
    },
  },
});
</script>
