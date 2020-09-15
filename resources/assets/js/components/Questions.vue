<template>
  <div class="main-questions">
    <div class="myQuestion" v-for="(question, index) in questions" :key="question">
      <div class="row">
        <div class="col-md-12">
          <blockquote>
            Total de Questões &nbsp;&nbsp;{{ index+1 }} / {{questions.length}}
          </blockquote>

          <div class="well well-lg">P. &nbsp;{{question.question}}</div>
      
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="well well-sm">Selecione a resposta que mais se encaixa no tópico</div>
                <form class="myForm" action="/quiz_start" v-on:submit.prevent="createQuestion(question.id, question.answer, auth.id, question.topic_id)" method="post">
                <ul class="list-group">
                  <li class="list-group-item list-group-item-success">
                  <input class="radioBtn" v-bind:id="'radio'+ index+2" type="radio" v-model="result.user_answer" value="C" aria-checked="false"> <span>{{question.c}}</span><br>
                  </li>
                  <li class="list-group-item list-group-item-warning">
                  <input class="radioBtn" v-bind:id="'radio'+ index" type="radio" v-model="result.user_answer" value="A" aria-checked="false"> <span>{{question.a}}</span><br>
                  </li>
                  <li class="list-group-item list-group-item-success">
                  <input class="radioBtn" v-bind:id="'radio'+ index+3" type="radio" v-model="result.user_answer" value="D" aria-checked="false"> <span>{{question.d}}</span><br>
                  </li>
                  <li class="list-group-item list-group-item-warning">
                    <input class="radioBtn" v-bind:id="'radio'+ index+1" type="radio" v-model="result.user_answer" value="B" aria-checked="false"> <span>{{question.b}}</span><br>
                  </li>
                  <div class="row">
                    <div class="col-md-3 col-xs-4">
                      <button type="submit" class="btn btn-wave btn-block nextbtn">Proximo</button>
                    </div>
                  </div>
                  </ul>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {

  props: ['topic_id'],

  data () {
    return {
      questions: [],
      answers: [],
      result: {
        question_id: '',
        answer: '',
        user_id: '',
        user_answer: 0,
        topic_id: '',
      },
      auth: [],
    }
  },

  created () {
    this.fetchQuestions();
  },

  methods: {

    fetchQuestions() {
      this.$http.get(`${this.$props.topic_id}/quiz/${this.$props.topic_id}`).then(response => {
        this.questions = response.data.questions;
        this.auth = response.data.auth;
      }).catch((e) => {
        console.log(e)
      });
    },

    createQuestion(id, ans, user_id, topic_id) {
      this.result.question_id = id;
      this.result.answer = ans;
      this.result.user_id = user_id;
      this.result.topic_id = this.$props.topic_id;
      this.$http.post(`${this.$props.topic_id}/quiz`, this.result).then((response) => {
        console.log('request completo');
      }).catch((e) => {
        console.log(e);
      });
      this.result.user_answer = 0;
      this.result.topic_id = '';
    }
  }
}
</script>