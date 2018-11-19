<template>
      <div class="row">
        <div class="col-xs-12 col-md-4">
            <section class="list">
                <header>Open Task</header>
                <draggable class="drag-area" :list="tasksOpenNew" :options="{animation:200, group:'status'}" :element="'article'" @add="onAdd($event, 0)"  @change="update">
                    <article class="cardOpen" v-for="(task, index) in tasksOpenNew" :key="task.id" :data-id="task.id" >
                      <a class="remove-item" @click="removeItem(task.id,index,0)">x</a>
                        <header style="font-size:14px;color:#222323;">
                            {{ task.title }}
                        </header>
                        <p style="font-size:12px;color:#222323;">{{ task.description }}</p>
                        <p style="font-size:12px;color:#222323;">{{ task.date_string }}</p>
                        <ul class="list-inline">
                          <li v-if="task.assignee != ''">
                              <p style="font-size:12px;color:#222323;">Assign Consultant: {{ task.assignee }}</p>
                          </li>
                          <li>
                              <p style="font-size:12px;color:#222323;">Company: {{ task.company }}</p>
                          </li>

                        </ul>
                        <a onclick="editTask(this)" :data-id="task.id" :data-title="task.title" :data-desc="task.description" :data-date="task.date" :data-company="task.company" :data-assignee="task.assignee" :data-creator="task.creator"  class="btn btn-primary btn-xs edit-item">Edit</a>
                    </article>
                </draggable>
            </section>
        </div>
        <div class="col-xs-12 col-md-4">
            <section class="list">
                <header>On-going Task</header>
                <draggable class="drag-area"  :list="tasksOnGoingNew" :options="{animation:200, group:'status'}" :element="'article'" @add="onAdd($event, 1)"  @change="update">
                    <article class="cardInProgress" v-for="(task, index) in tasksOnGoingNew" :key="task.id" :data-id="task.id" >
                      <a class="remove-item" @click="removeItem(task.id, index,1)">x</a>
                        <header  style="font-size:14px;color:#222323;">
                            {{ task.title }}
                        </header>
                        <p  style="font-size:12px;color:#222323;">{{ task.description }}</p>
                        <p  style="font-size:12px;color:#222323;">{{ task.date_string }}</p>
                        <ul class="list-inline">
                          <li v-if="task.assignee != ''">
                              <p  style="font-size:12px;color:#222323;">Assign Consultant: {{ task.assignee }}</p>
                          </li>
                          <li>
                              <p  style="font-size:12px;color:#222323;">Company: {{ task.company }}</p>
                          </li>
                        </ul>
                        <a onclick="editTask(this)" :data-id="task.id" :data-title="task.title" :data-desc="task.description" :data-date="task.date" :data-company="task.company" :data-assignee="task.assignee" :data-creator="task.creator"  class="btn btn-primary btn-xs edit-item">Edit</a>
                    </article>
                </draggable>
            </section>
        </div>
        <div class="col-xs-12 col-md-4">
            <section class="list">
                <header>Closed Task</header>
                <draggable class="drag-area"  :list="tasksClosedNew" :options="{animation:200, group:'status'}" :element="'article'" @add="onAdd($event, 2)"  @change="update">
                    <article class="cardClosed" v-for="(task, index) in tasksClosedNew" :key="task.id" :data-id="task.id">
                      <a class="remove-item" @click="removeItem(task.id, index,2)">x</a>
                        <header style="font-size:14px;color:#222323;">
                            {{ task.title }}
                        </header>
                        <p style="font-size:12px;color:#222323;">{{ task.description }}</p>
                        <p style="font-size:12px;color:#222323;">{{ task.date_string }}</p>
                        <ul class="list-inline">
                          <li v-if="task.assignee != ''">
                              <p  style="font-size:12px;color:#222323;">Assign Consultant: {{ task.assignee }}</p>
                          </li>
                          <li>
                              <p  style="font-size:12px;color:#222323;">Company: {{ task.company }}</p>
                          </li>
                        </ul>
                        <a onclick="editTask(this)" :data-id="task.id" :data-title="task.title" :data-desc="task.description" :data-date="task.date" :data-company="task.company" :data-assignee="task.assignee" :data-creator="task.creator"  class="btn btn-primary btn-xs edit-item">Edit</a>
                    </article>
                </draggable>
            </section>
        </div>
    </div>
</template>


<script>
  import draggable from 'vuedraggable';
  export default {
    components: {
      draggable
    },
    props: ['tasksOpen', 'tasksOnGoing', 'tasksClosed'],
    data() {
      return {
        tasksOpenNew: this.tasksOpen,
        tasksOnGoingNew: this.tasksOnGoing,
        tasksClosedNew: this.tasksClosed,
        modalShow: false
      }
    },
    methods: {
      onAdd(event, status) {
        let id = event.item.getAttribute('data-id');
        //change to ajax
        axios.patch('/tasks/' + id, {
          status: status
        }).then((response) => {
          console.log(response.data);
          new PNotify({
            title: (response.status == 200 ? "Success!" : "Failed!"),
            text: (response.status == 200 ? "Task successfully moved!" : "Task failed to be moved!"),
            type: (response.status == 200 ? "success" : "error"),
            styling: 'bootstrap3'
          });
        }).catch((error) => {
          console.log(error);
          // new PNotify({
          //     title: "Something Happened!",
          //     text: error,
          //     type: "error"),
          //   styling: 'bootstrap3'
          // });
        })
      },
      update() {
        this.tasksOpen.map((task, index) => {
          task.order = index + 1;
        });

        this.tasksOnGoing.map((task, index) => {
          task.order = index + 1;
        });
        this.tasksClosed.map((task, index) => {
          task.order = index + 1;
        });

        let tasks = this.tasksClosed.concat(this.tasksOnGoing).concat(this.tasksOpen);
        //change to ajax

        axios.put('/tasks/updateAll/', {
          tasks: tasks
        }).then((response) => {
          console.log(response.data);
        }).catch((error) => {
          console.log(error);

        })
      },
      removeItem(taskid, index, type) {
        //change to ajax
        axios.patch('/tasks/remove/' + taskid, {
          status: status
        }).then((response) => {
          console.log(response.status);
          new PNotify({
            title: (response.status == 200 ? "Success!" : "Failed!"),
            text: (response.status == 200 ? "Task successfully removed!" : "Task failed to be removed!"),
            type: (response.status == 200 ? "success" : "error"),
            styling: 'bootstrap3'
          });
        }).catch((error) => {
          console.log(error);
          // new PNotify({
          //     title: "Something Happened!",
          //     text: error,
          //     type: "error"),
          //   styling: 'bootstrap3'
          // });
        });
        if (type == 0) {
          this.tasksOpenNew.splice(index, 1);
        } else if (type == 1) {
          this.tasksOnGoingNew.splice(index, 1);
        } else {
          this.tasksClosedNew.splice(index, 1);
        }
        // this.update();
      },
      showModal() {
        this.$root.$emit('bv::show::modal', 'modal1')
      },
      hideModal() {
        this.$root.$emit('bv::hide::modal', 'modal1')
      },
      onHidden(evt) {
        // Return focus to our Open Modal button
        // See accessibility below for additional return-focus methods
        this.$refs.btnShow.$el.focus()
      }
    }
  }
</script>

<style>
  .list {
    background-color: #25192B;
    border-radius: 3px;
    margin: 5px 5px;
    padding: 10px;
    width: 100%;
  }

  .list>header {
    font-weight: bold;
    color: white;
    text-align: center;
    font-size: 20px;
    line-height: 28px;
    cursor: grab;
  }

  .list p {
    color: grey;
    text-align: left;
    font-size: 10px;
  }


  .list article {
    border-radius: 3px;
    margin-top: 10px;
  }

  .list .cardInProgress {
    background-color: #F6F6F2;
    border-bottom: 1px solid #C6C7C1;
    padding: 15px 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bolder;
  }

  .list .cardClosed {
    background-color: #F6F6F2;
    border-bottom: 1px solid #C6C7C1;
    padding: 15px 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bolder;
  }

  .list .cardOpen {
    background-color: #F6F6F2;
    border-bottom: 1px solid #C6C7C1;
    padding: 15px 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bolder;
  }


  .list .card:hover {
    background-color: #F0F0F0;
  }

  .drag-area {
    min-height: 10px;
  }

  .remove-item {
    float: right;
    color: #CA3C25;
    opacity: 0.5;
    font-size: 1.5em;
  }

  .remove-item:hover {
    float: right;
    color: #CA3C25;
    opacity: 1;
  }

  .edit-item {
    margin-left: 85%;
    background: #32213A;
    color: white;
    opacity: 0.5;
    font-size: 1em;
  }

  .edit-item:hover {
    margin-left: 85%;
    background: #CDC8D2;
    color: white;
    opacity: 1;
  }
</style>