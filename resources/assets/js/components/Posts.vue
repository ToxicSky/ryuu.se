<template>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Posts</div>

        <div class="panel-body">
          <div class="col-md-12">
            <div v-for="post of posts" class="row">
              <div class="panel panel-default">
                <div class="panel-heading">{{ post.title }} <small>({{ post.category.title }})</small></div>
                <div class="panel-body">
                  <p>{{ post.body }}</p>
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="list-unstyled">
                        <li v-for="tag of post.tags">{{ tag.title }}</li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">Created: {{ post.created_at }}</div>
                    <div class="col-md-6">Updated: {{ post.updated_at }}</div>
                  </div>
                </div>
                <div class="panel-footer" v-if="post.comments" v-for="c of post.comments">
                  <div class="comment">
                    <div class="row">
                      <div class="col-xs-12">
                        {{ c.name }}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        {{ c.comment }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pagination">
              <a v-if="paginate.previous" v-on:click="get_posts(paginate.previous)">Previous</a>
              <a v-for="i in paginate.last" v-bind:class="paginate.current_class(i)" v-on:click="get_posts(null, i)">{{ i }}</a>
              <a v-if="paginate.next" v-on:click="get_posts(paginate.next)">Next</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
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
