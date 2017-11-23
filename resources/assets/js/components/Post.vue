<template>
  <div class="posts">
    <div class="post" v-if="post">
      <h2>{{ post.title }} <small>({{ post.category.title }})</small></h2>
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
        <comments :post_id="post.id" :post_comments="true" ></comments>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['post', 'comments'],
  data () {
    return {
      moment: window.moment,
    }
  },
  mounted() {},
  methods: {}
}
</script>
