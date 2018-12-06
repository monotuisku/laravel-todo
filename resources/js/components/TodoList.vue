<template>
  <div class="">
    <!-- ①todoの追加 newTodoに値を渡して、enterキーでaddTodoメソッド実行　-->
    <input type="text" name="todo-input" placeholder="input Tasks..." class="todo-input" v-model="newTodo" @keyup.enter="addTodo">
    <!-- ②todoのリストを表示 -->
    <ul class="todo-list">
      <li v-for="(todo, index) in todos" :key="todo.id" class="todo-list__item">
        <div class="todo-list__textarea">

          <!-- ③todoのcompletedのステータスと同期 -->
          <input type="checkbox" v-model="todo.completed" class="todo-list__check">

          <!-- ④ダブルクリックで編集editTodoメソッド実行　completedがtrueの場合は、completedクラスを追加 -->
          <span v-if="!todo.editing" @dblclick="editTodo(todo)" class="todo-list__label" :class="{completed:todo.completed}">{{todo.title}}</span>
          <input v-else type="text" v-model="todo.title" class="todo-list__edit" @blur="doneEdit(todo)" @keyup.enter="doneEdit(todo)" @keyup.esc="cancelEdit(todo)" v-focus>
        </div>

        <!-- ⑤todoの削除 クリックでremoveTodoメソッド実行　-->
        <span class="todo-list__bin" @click="removeTodo(index)">&times;</span>
      </li>
    </ul>

    <!-- ⑥残りタスクを計算して表示 -->
    <p>{{remaining}} items left</p>
  </div>
</template>

<script>
export default {
  name: 'todo-list',
  data () {
    return {
      newTodo: '',
      beforeEditCache : '',
      idForTodo: 3,
      todos: [
        {
          'id': 1,
          'title': 'First Task',
          'completed': false,
          'editing': false,
        },
        {
          'id': 2,
          'title': 'Second Task',
          'completed': false,
          'editing': false,
        },
      ]
    }
  },
  directives: {
    focus: {
      inserted: function (el) {
        el.focus()
      }
    }
  },
  computed: {
    remaining () {
      return this.todos.filter(todo => !todo.completed).length
    },
  },
  methods: {
    addTodo () {
      var value = this.newTodo && this.newTodo.trim()
      if(!value) {
        //もし内容が空ならメソッドここでおわり
        return
      }
      //todosの配列にプッシュ
      this.todos.push({
        'id': this.idForTodo,
        'title': this.newTodo,
        'completed': false,
        'editing': false,
      })
      //配列に追加が終わったら、newtodoを空にして、idをインクリメント
      this.newTodo = ''
      this.idForTodo++
    },
    editTodo(todo) {
      todo.beforeEditCache = todo.title
      todo.editing = true
    },
    doneEdit(todo) {
      var value = todo.title && todo.title.trim()
      if(!value) {
        todo.title = todo.beforeEditCache
      }
      todo.editing = false
    },
    cancelEdit(todo) {
      todo.title = todo.beforeEditCache
      todo.editing = false
    },
    removeTodo(index) {
      this.todos.splice(index, 1)
    },
  }
}
</script>
<style lang="scss">
  .todo-input {
    font-size: 16px;
    padding:8px 16px;
    width:100%;
  }
  .todo-list {
    padding: 0;
    margin-top: 16px;
    &__item {
      display: flex;
      justify-content: space-between;
      padding: 4px 0;
    }
    &__check {
      margin-right: 8px;
    }
    &__textarea {
      display: flex;
      align-items: center;
    }
    &__bin {
      cursor: pointer;
    }
    &__label {
      padding: 8px;
      border-bottom: 1px solid #e0e0e0;
      &.completed {
        text-decoration: line-through;
        color: grey;
      }
    }
    &__edit {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      font-size: 24px;
    }
  }
</style>
