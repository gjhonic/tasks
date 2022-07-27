let app = new Vue({
    el: '#app',
    data: {
        config: {
            projectName: 'Tasks',
            version: '0.1',
            lang: 'en',
            author: 'gjhonic',
        },
        //Модалки
        showModalItemTask: false,
        showModalItemBranch: false,
        //Ссылки
        url_get_tasks: '../backend/actions/get-tasks.php',
        url_get_branches: '../backend/actions/get-branches.php',
        url_create_tasks: '../backend/actions/create-task.php',
        url_create_branch: '../backend/actions/create-branch.php',
        url_update_tasks: '../backend/actions/update-task.php',
        url_delete_tasks: '../backend/actions/delete-task.php',
        url_delete_branch: '../backend/actions/delete-branch.php',
        //Данные
        tasksData: [],
        branchesData: [],
        property: '',
    },
    computed: {
        Tasks() {
            return this.tasksData;
        },
        Branches() {
            return this.branchesData;
        },
    },
    methods: {
        loadTasks(callback) {
            fetch(this.url_get_tasks, {
                method: "GET",
            }).then(response => response.json()).then(data => {
                if (data.error === false) {
                    this.tasksData = data.tasks;
                }

                console.log(this.tasksData);

                if (typeof callback !== 'undefined') {
                    let timerId = setTimeout(function () {
                        callback();
                    }, 500);
                }
            });
        },
        loadBranches(callback) {
            fetch(this.url_get_branches, {
                method: "GET",
            }).then(response => response.json()).then(data => {
                if (data.status == 'success') {
                    this.branchesData = data.dataBranches;
                }

                if (typeof callback !== 'undefined') {
                    let timerId = setTimeout(function () {
                        callback();
                    }, 500);
                }
            });
        },
        //Удаление записи с предупреждением
        stopperDelete(url, id) {
            let answer = confirm("Are you sure you want to delete this item?");
            console.log(url + '?id=' + id);
            if(answer == true) {
                let body = {
                    id: id
                };
                fetch(url, {
                    method: "POST",
                    body: JSON.stringify(body),
                }).then((response) => response.json())
                    .then((data) => {
                        if(data.status == 'success') {
                            location.reload();
                        } else {
                            alert(data.message)
                        }
                    });
            }
        }
    },
    mounted() {
        this.loadTasks();
        this.loadBranches();
    },
});
