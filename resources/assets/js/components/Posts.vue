<template>
  <div class="posts">
    <div class="post" v-for="post of posts">
      <h2><a v-bind:href="'/posts/' + post.id">{{ post.title }}</a> <small>({{ post.category.title }})</small></h2>
      <div class="time">
        <span class="created">{{ moment(post.created_at).format('Y-MM-DD HH:mm') }}</span>
        <span class="updated" v-if="moment(post.created_at) !== moment(post.updated_at)">(Edited {{ moment(post.updated_at).format('Y-MM-DD HH:mm') }})</span>
      </div>
      <p>{{ post.body }}</p>
      <div>
        <div>
          <ul class="list-unstyled">
            <li v-for="tag of post.tags">{{ tag.title }}</li>
          </ul>
        </div>
      </div>
      <div>
        <comments :post_id="post.id" :post_comments="false" ></comments>
      </div>
    </div>
    <div class="pagination">
      <a v-if="paginate.previous" v-on:click="get_posts(paginate.previous)">Previous</a>
      <a v-for="i in paginate.last" v-bind:class="paginate.current_class(i)" v-on:click="get_posts(null, i)">{{ i }}</a>
      <a v-if="paginate.next" v-on:click="get_posts(paginate.next)">Next</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ['comments'],
  data () {
    return {
      moment: window.moment,
      posts: [],
      page: 1,
      paginate: {
        previous: null,
        next: null,
        current: 1,
        last: 1,
        current_class: function (index) {
          return this.current == index ? 'current' : ''
        }
      }
    }
  },
  mounted() {
    this.get_posts();
  },
  methods: {
    get_posts: function (url, page = null) {
      if (!url) {
        url = '/api/posts?page={0}'.format(page);
      }
      axios.get(url).then(response => {
        let d = response.data,
        p = this.paginate;

        p.previous = d.prev_page_url;
        p.next     = d.next_page_url;
        p.current  = d.current_page;
        p.last     = d.last_page;

        if (d.hasOwnProperty('data')) {
          this.posts = d.data;
        }

      }).catch(error =>  {
        console.log(error);
      });
    }
  }
}
</script>
