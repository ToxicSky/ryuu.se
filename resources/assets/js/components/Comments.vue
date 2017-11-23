<template>
  <div class="comments">
    <div class="new-comment" v-if="post_comments">
      <form method="post" v-bind:action="post_comment_url" v-if="post_comment_url.length > 0">
        <input type="hidden" name="post_id" v-bind:value="post_id" />
        <div class="comment-input">
          <input name="name" placeholder="Name..." v-model="new_comment.name" requried />
        </div>
        <div class="comment-input">
          <input name="email" type="email" placeholder="E-mail..." v-model="new_comment.email" required />
        </div>
        <div class="comment-content">
          <textarea name="comment" placehold="Comment..." v-model="new_comment.comment" ></textarea>
        </div>
        <div class="comment-submit-btn">
          <button type="button" v-on:click="post_comment()">Comment</button>
        </div>
      </form>
    </div>
    <div class="comment" v-if="comments" v-for="c of comments">
      <div>
        <div>
          {{ c.name }} {{ moment(c.created_at).format('Y-MM-DD HH:mm') }}
        </div>
      </div>
      <div>
        <div>
          {{ c.comment }}
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: ['post_id', 'post_comments'],
  data () {
    return {
      moment: window.moment,
      comments: [],
      post_comment_url: '',
      new_comment: {
        name: null,
        email: null,
        comment: null,
        post_id: this.post_id
      }
    }
  },
  mounted() {
    this.get_comments();
    this.$routeLaravel('api.comments.store').url()
         .then(response => this.post_comment_url = response);
  },
  methods: {
    get_comments: function () {
      let url = '/api/comments?post_id={0}'.format(this.post_id);
      axios.get(url).then(response => {
        if (response.hasOwnProperty('data')) {
          this.comments = response.data;
        }
      }).catch(error =>  {
        console.log(error);
      });
    },

    post_comment: function () {
      if (this.post_comment_url.length > 0) {
        axios.post(
          this.post_comment_url,
          this.new_comment
        ).then(response => {
          if(response.status === 201) {
            this.get_comments();
          }

          this.new_comment = {
            name: null,
            email: null,
            comment: null,
            post_id: this.post_id
          };
        }).catch(error => {
          console.log(error);
        })
      }
    }
  }
}
</script>
