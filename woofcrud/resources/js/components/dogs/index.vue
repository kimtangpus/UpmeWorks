<template>
  <div>
    <h1 class="text-center mt-5">Dogs</h1>
  </div>

  <section class="home py-5" id="home" style="background-color: #f8f9fa;">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center px-5">
        <div class="col-md-6 pb-5">
          <h1 class="display-4 fw-bold mb-4">
            <span style="color: #0078D0;">Welcome to Woofopedia</span>
          </h1>
          <p class="lead mb-4">
            <span style="color: #00A651;">Discover and learn about your favorite dog breeds</span>
          </p>
          <a href="#doggos" class="btn btn-lg btn-primary rounded-pill px-5 py-3 shadow-lg">Explore</a>
        </div>
        <div class="col-md-6">
          <img src="https://i.postimg.cc/FHFQcVwG/dogs.jpg" class="img-fluid rounded-5 shadow-lg mx-auto d-block" alt="Dogs" />
        </div>
      </div>
    </div>
  </section>

  <section id="doggos" class="py-5">
    <div class="container">
      <h1 class="text-center mb-5" style="font-size: 45px; color: #0078D0;">Dog Sizes</h1>

      <form @submit.prevent="searchBreeds" class="d-flex justify-content-center mb-5">
        <input
          v-model="searchQuery"
          class="form-control w-50 me-3 rounded-pill shadow-sm px-4 py-3"
          type="text"
          name="search"
          placeholder="Search for breeds"
          aria-label="Search"
        />
        <button class="btn btn-success rounded-pill px-5 py-3 shadow-lg" type="submit">Search</button>
      </form>

      <!-- sample card -->
      <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card shadow-lg border-0 h-100" style="background-color: #f8f9fa;">
            <img class="card-img-top rounded-top" src="https://via.placeholder.com/300x200" alt="Golden Retriever" />
            <div class="card-body text-center rounded-bottom p-4" style="background-color: #0078D0; color: #fff;">
              <h3 class="card-title mb-3">Golden Retriever</h3>
              <p class="desc mb-4">Friendly, intelligent, and devoted breed known for its golden coat and gentle nature.</p>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-light text-dark btn-sm rounded-pill px-4">Edit</button>
                <button type="button" class="btn btn-danger btn-sm rounded-pill px-4">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-for="size in sizes" :key="size.sizeID" class="mb-5">
        <h2 class="text-center mt-5 mb-4" style="font-size: 35px; color: #F0282D;">{{ size.sizeName }}</h2>

        <div class="row mt-4 justify-content-center">
          <div v-for="dog in getDogsBySize(size.sizeID)" :key="dog.breedID" class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card shadow-lg border-0 h-100" :style="{ backgroundColor: dog.backgroundColor }">
              <img class="card-img-top rounded-top" :src="dog.image" :alt="dog.breedName" />
              <div class="card-body text-center rounded-bottom p-4" style="background-color: #0078D0; color: #fff;">
                <h3 class="card-title mb-3">{{ dog.breedName }}</h3>
                <p class="desc mb-4">{{ dog.description }}</p>
                <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-light text-dark btn-sm rounded-pill px-4" @click="editBreed(dog)">Edit</button>
                  <button type="button" class="btn btn-danger btn-sm rounded-pill px-4" @click="deleteBreed(dog.breedID)">Delete</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
