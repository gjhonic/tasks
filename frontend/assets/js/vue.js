let app = new Vue({
    el: '#app',
    data: {
        config: {
            projectName: 'Tasks',
            version: '0.1',
            lang: 'en',
            author: 'gjhonic',
        },
        //Ссылки
        url_get_tasks: '../backend/actions/get-tasks.php',
        url_create_tasks: '../backend/actions/create-task.php',
        url_update_tasks: '../backend/actions/update-task.php',
        url_delete_tasks: '../backend/actions/delete-task.php',
        //Данные
        tasks: [],
        property: '',
    },
    methods: {
        loadTasks() {
            fetch(this.url_get_tasks, {
                method: "GET",
            }).then(response => response.json()).then(data => {
                if (data.error === false) {
                    this.tasks = data.tasks;
                }

                console.log(this.tasks);
            });
        }
    },
    mounted() {
        this.loadTasks();
        console.log(123);
    },
});
