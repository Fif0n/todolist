var app = new Vue({
  el: '#app',
    data: {
      errorMsg: "",
      todos: [],
      newTodo: {
        id: "",
        title: "",
        compleated: ""
      },
      currentTodo: {}
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
      },
      toFormData(obj){
        var fd = new FormData();
        for(var i in obj){
          fd.append(i,obj[i]);
        } return fd;
      },

      selectTodo(todo){
        app.currentTodo = todo;
      },

      addTodo(){
        var formData = app.toFormData(app.newTodo);
        axios.post("http://localhost/todolist/process.php?action=create", formData)
        .then(function(response){
          app.newTodo = {id: "", title: "", compleated: 0};
          app.getTodos();
          if(response.data.error){
            app.errorMsg = respones.data.message;
          } else {
            app.getTodos();
          }
        });
      },

      deleteTodo(){
        var formData = app.toFormData(app.currentTodo);
        axios.post("http://localhost/todolist/process.php?action=delete", formData)
        .then(function(response){
          app.currentTodo = {};
          app.getTodos();
          if(response.data.error){
            app.errorMsg = respones.data.message;
          } else {
            app.getTodos();
          }
        });
        
      },

      makeCompleated(){
        var formData = app.toFormData(app.currentTodo);
        axios.post("http://localhost/todolist/process.php?action=compleated", formData)
        .then(function(response){
          app.currentTodo = {};
          app.getTodos();
          if(response.data.error){
            app.errorMsg = respones.data.message;
          } else {
            app.getTodos();
          }
        });
      },

      makeUnCompleated(){
        var formData = app.toFormData(app.currentTodo);
        axios.post("http://localhost/todolist/process.php?action=makeU", formData)
        .then(function(response){
          app.currentTodo = {};
          app.getTodos();
          if(response.data.error){
            app.errorMsg = respones.data.message;
          } else {
            app.getTodos();
          }
        });
      }

    },

    computed: {

    }
  
})
