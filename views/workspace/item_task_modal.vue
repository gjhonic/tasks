<script type="text/x-template" id="item-task-template">
<transition name="modal-item-task">
<div class="modal-mask">
  <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Adding a new task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="$emit('close')"></button>
      </div>

      <div class="modal-body">
        <slot name="body">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Number</label>
            <input type="number" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="recipient-branch" class="col-form-label">Branch</label>
            <select class="form-select" id="recipient-branch">
              <option value="0">Not set</option>
              <option v-for="branch in Branches" v-bind:value="branch.id">
                {{ branch.name }}
              </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="field-comment" class="col-form-label">Comments</label>
            <textarea class="form-control" id="field-comment" style="height: 100px"></textarea>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Status</label>
            <select class="form-select" aria-label="Default select example">
              <option value="1" selected>New</option>
              <option value="2">Active</option>
              <option value="3">Test</option>
              <option value="4">Pause</option>
            </select>
          </div>
        </slot>
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" @click="$emit('close')">Close</button>
          <span class="hidden-elem">*</span>
          <button type="button" class="btn btn-outline-primary">Create task</button>
      </div>
    </div>
  </div>
</div>
</transition>
</script>

<script>
Vue.component("modal-item-task", {
  template: "#item-task-template",
  data() {
    return {
    };
  },
  computed: {
    Branches() {
      return app.branchesData;
    },
  },
  methods: {
    open() {
      console.log('123');
    },
    save() {
      let name = $("#field-branch-name").val();
      let comment = $("#field-branch-comment").val();

      let body = {
        name: name,
        comment: comment,
      };
      let url = app.url_create_task;

      fetch(url, {
        method: "POST",
        body: JSON.stringify(body),
      }).then((response) => response.json())
        .then((data) => {
          if(data.status == 'success') {
            app.loadBranches();
            app.showModalItemBranch = false;
          } else {
            $("#alert-danger-item-branch").html(data.message);
            $("#alert-danger-item-branch").css('display', 'block');
          }
        });
    },
  },
});
</script>
