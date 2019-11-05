var app = new Vue({
  el: '#app',
    data: {
      todos: [],
      newTodo: {
        id: "",
        title: "",
        compleated: ""
      },
      currentTodo: {},
      filter: 'all'
    },

    mounted: function(){
      this.getTodos();
    },

    methods: {
      getTodos(){
        axios.get("http://localhost/todolist/process.php?action=read")
        .then(function(response){
          app.todos = response.data.todo;
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
        .then(function(){
            app.newTodo = {id: "", title: "", compleated: 0};
            app.getTodos();
        });
      },

      deleteTodo(){
        var formData = app.toFormData(app.currentTodo);
        axios.post("http://localhost/todolist/process.php?action=delete", formData)
        .then(function(){
          app.currentTodo = {};
          app.getTodos();
        });
        
      },

      makeCompleated(){
        var formData = app.toFormData(app.currentTodo);
        axios.post("http://localhost/todolist/process.php?action=compleated", formData)
        .then(function(){
          app.currentTodo = {};
          app.getTodos();
        });
      },

      makeUnCompleated(){
        var formData = app.toFormData(app.currentTodo);
        axios.post("http://localhost/todolist/process.php?action=makeU", formData)
        .then(function(){
          app.currentTodo = {};
          app.getTodos();
        });
      },
      clearCompleate(){
        axios.post("http://localhost/todolist/process.php?action=deleteC")
        .then(function(){
          app.getTodos();
        });
      },

    },

    computed: {
      
    }
  
})
