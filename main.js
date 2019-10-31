var app = new Vue({
  el: '#app',
    data: {
      errorMsg: "",
      successMsg: "",
      todos: [],
      newTodo: {
        id: "",
        title: "",
        compleated: ""
      }
    },
    mounted: function(){
      this.getTodos();
    },
    methods: {
      getTodos(){
        axios.get("http://localhost/todolist/process.php?action=read")
        .then(function(response){
          if(response.data.error){
            app.errorMsg = respones.data.message;
          } else {
            app.todos = response.data.todo;
          }
        });
      }
    },

    computed: {

    }
  
})
