<template>
  <div>
    <div class="comment" v-if="comments" v-for="c of comments">
      <div>
        <div>
          {{ c.name }}
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
  props: ['post_id'],
  data () {
    return {
      comments: []
    }
  },
  mounted() {
    this.get_comments();
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
    }
  }
}
</script>
