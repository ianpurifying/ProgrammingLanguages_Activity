<?php include 'header.php' ?>

<!-- About Section -->
<section class="pt-24 pb-16 bg-gradient-to-br from-slate-50 to-gray-100">
  <div class="container mx-auto px-6">
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">About Me</h1>
      <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full"></div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
      <!-- Image Section -->
      <div class="order-2 lg:order-1">
        <div class="relative">
          <div class="relative z-10 transform hover:scale-105 transition-transform duration-500">
            <img src="haha.jpg" alt="Nica Angelene M. Comia" class="w-full max-w-md mx-auto rounded-2xl shadow-2xl object-cover aspect-square">
            <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent rounded-2xl"></div>
          </div>
          
          <!-- Decorative Elements -->
          <div class="absolute -top-6 -right-6 w-24 h-24 bg-indigo-500/20 rounded-full blur-xl animate-pulse"></div>
          <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-purple-500/20 rounded-full blur-xl animate-pulse delay-1000"></div>
        </div>
      </div>
      
      <!-- Content Section -->
      <div class="order-1 lg:order-2 space-y-8">
        <div class="space-y-6">
          <p class="text-lg text-gray-700 leading-relaxed">
            I'm <span class="font-semibold text-indigo-600">Nica Angelene M. Comia</span>, 21 years old, a passionate photographer capturing life's special moments with creativity and emotion. With years of experience behind the lens, I specialize in portraits, events, and lifestyle shoots that tell stories and preserve memories.
          </p>
          
          <p class="text-lg text-gray-700 leading-relaxed">
            Whether it's a candid smile, a powerful silhouette, or the light just hitting right—every shot matters. My goal is to provide not just pictures, but timeless visual experiences that you'll treasure forever.
          </p>
        </div>
        
        <!-- Skills/Stats -->
        <div class="grid grid-cols-2 gap-6">
          <div class="text-center p-4 bg-white rounded-xl shadow-md">
            <div class="text-3xl font-bold text-indigo-600 mb-2">5+</div>
            <div class="text-gray-600">Years Experience</div>
          </div>
          <div class="text-center p-4 bg-white rounded-xl shadow-md">
            <div class="text-3xl font-bold text-indigo-600 mb-2">500+</div>
            <div class="text-gray-600">Happy Clients</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Philosophy Section -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-6">
    <div class="max-w-4xl mx-auto">
      <div class="bg-indigo-50 rounded-2xl p-8 md:p-12 border border-indigo-100">
        <div class="text-center mb-8">
          <i class="fas fa-quote-left text-4xl text-indigo-600 mb-4"></i>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Why "Click by Nica"?</h2>
        </div>
        
        <p class="text-xl text-gray-700 leading-relaxed text-center mb-8">
          The name reflects my signature style—quick, real, and full of personality. "Click" isn't just the sound of the camera, it's the connection I build with every subject I work with.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
          <div class="text-center">
            <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-bolt text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Quick</h3>
            <p class="text-gray-600">Capturing the perfect moment in the blink of an eye</p>
          </div>
          
          <div class="text-center">
            <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-star text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Real</h3>
            <p class="text-gray-600">Authentic emotions and genuine connections</p>
          </div>
          
          <div class="text-center">
            <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-sparkles text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Personal</h3>
            <p class="text-gray-600">Every shot reflects your unique personality</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-700">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Create Beautiful Memories?</h2>
    <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
      Let's work together to capture your special moments with creativity and passion.
    </p>
    <div class="space-x-4">
      <a href="inquire.php" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg">
        <i class="fas fa-camera mr-2"></i>Book a Session
      </a>
      <a href="contact.php" class="inline-block border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-indigo-600 transform hover:scale-105 transition-all duration-300">
        <i class="fas fa-envelope mr-2"></i>Get in Touch
      </a>
    </div>
  </div>
</section>

<?php include 'footer.php' ?>