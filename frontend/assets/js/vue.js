var app = new Vue({
    el: '#app',
    data: {
      config: {
          projectName: 'Tasks',
          version: '0.1',
          lang: 'en',
          author: 'gjhonic',
      },
      //Данные
      tasks: [],
      property: '',
    },
    mounted: function () {
      console.log('Test 123');
      this.property = 'Example property updated.';
    },
  });

  app.mount('#app');