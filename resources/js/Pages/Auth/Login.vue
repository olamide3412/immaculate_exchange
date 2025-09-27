<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import Logo from '../../../images/logo.png'
import Footer from '@/Components/Footer.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { useToast } from 'vue-toastification';

const toast = useToast();
const flashMsg = usePage().props.flash.message;
const form = useForm({
  email: null,
  password: null,
  remember: false,
  cf_turnstile_response: '',
});

const turnstileWidgetId = ref(null);
const isTurnstileLoaded = ref(false);
const turnstileError = ref('');

// Load Cloudflare Turnstile script
const loadTurnstile = () => {
    if (window.turnstile) {
        renderTurnstile();
        return;
    }

    const script = document.createElement('script');
    script.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit';
    script.async = true;
    script.defer = true;

    script.onload = () => {
        isTurnstileLoaded.value = true;
        renderTurnstile();
    };

    script.onerror = () => {
        turnstileError.value = 'Failed to load CAPTCHA. Please refresh the page.';
    };

    document.head.appendChild(script);
};
// Render Turnstile widget
const renderTurnstile = () => {
    if (window.turnstile && document.getElementById('cf-turnstile-widget')) {
        turnstileWidgetId.value = window.turnstile.render('#cf-turnstile-widget', {
            sitekey: usePage().props.turnstileSiteKey,
            callback: (token) => {
                form.cf_turnstile_response = token;
                turnstileError.value = '';
            },
            'expired-callback': () => {
                form.cf_turnstile_response = '';
                turnstileError.value = 'CAPTCHA expired. Please verify again.';
                resetTurnstile();
            },
            'error-callback': () => {
                form.cf_turnstile_response = '';
                turnstileError.value = 'CAPTCHA error. Please try again.';
                resetTurnstile();
            }
        });
    }
};
// Reset Turnstile widget
const resetTurnstile = () => {
    if (window.turnstile && turnstileWidgetId.value) {
        window.turnstile.reset(turnstileWidgetId.value);
    }
};
// Reload Turnstile
const reloadTurnstile = () => {
    resetTurnstile();
    form.cf_turnstile_response = '';
    turnstileError.value = '';
};
// Load Turnstile when component mounts
onMounted(() => {
    loadTurnstile();
});

const handleLogin = () => {
    if (!form.cf_turnstile_response) {
        turnstileError.value = 'Please complete the CAPTCHA verification';
        return;
    }

  // Handle login logic here
  form.post(route('login'),{
         onFinish: () => {
            form.reset('password');
            // Reset Turnstile after submission
            resetTurnstile();
        },
        onError: () => {
            form.reset("password");
            toast.error(form.errors.email ?? 'Something went wrong try again');
            // Reset Turnstile on error
            if (form.errors.cf_turnstile_response) {
                resetTurnstile();
                form.cf_turnstile_response = '';
            }
        },
        onSuccess: () => {
            toast.success('Login succesfull!!!');
            if(flashMsg){
                toast.error(flashMsg);
            }
            form.reset();
        }
    });
}


</script>
<template>
    <div class="min-h-screen  flex items-center justify-center px-4 my-6">
      <!-- Login Card -->
      <div
        class="w-full max-w-md bg-white dark:bg-slate-900 rounded-lg shadow-lg p-5 space-y-6"
        data-aos="zoom-out"
        data-aos-duration="600"
      >
        <!-- Logo -->
        <div class="text-center">
          <img
            :src="Logo"
            alt="Logo"
            class="h-12 mx-auto mb-4"
          />
          <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Login to Your Account</h2>
          <p class="text-sm text-gray-500 dark:text-gray-200 mt-2">Welcome back! Please login to continue.</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="handleLogin" class="mt-6 space-y-6">
          <!-- Email -->
          <TextInput name="email" label="Email" v-model="form.email"
            placeholder="you@example.com" :message="form.errors.email"/>
           <!-- Password -->
          <TextInput name="password" label="Password" type="password"
            v-model="form.password" placeholder="••••••••"/>

             <!-- Cloudflare Turnstile Widget -->
            <div class="flex justify-left">
                <div id="cf-turnstile-widget" class="cf-turnstile"></div>
            </div>
            <div v-if="turnstileError" class="text-red-600 text-sm text-center">
                {{ turnstileError }}
            </div>
            <div v-if="form.errors.cf_turnstile_response" class="text-red-600 text-sm text-center">
                {{ form.errors.cf_turnstile_response }}
            </div>
            <div class=" text-center">
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500" @click.prevent="reloadTurnstile">
                    Reload CAPTCHA
                </a>
            </div>
            <!-- Cloudflare Turnstile Widget Ends Here -->
          <!-- Remember Me & Forgot Password -->
          <div class="flex items-center justify-between">
            <label class="flex items-center">
              <input
                type="checkbox"
                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                v-model="form.remember"
              />
              <span class="ml-2 text-sm text-gray-600 dark:text-gray-200">Remember me</span>
            </label>
            <a href="#" class="hidden text-sm text-primary hover:text-primary-dark">Forgot password?</a>
          </div>

          <!-- Submit Button -->
          <button class="btn-primary font-semibold w-full transition-transform transform hover:scale-[1.02]" :disabled="form.processing">Sign in</button>

        </form>

        <!-- Divider -->
        <div class=" hidden relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">Or continue with</span>
          </div>
        </div>

        <!-- Social Buttons -->
        <div class=" hidden grid grid-cols-3 gap-3">
          <button
            type="button"
            class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
          >
            <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z" />
              <path d="M9.928 13.228l-2.499-.001v-1.501l2.499.001V8.229l2.5.001v4.998l2.499-.001v1.501H12.427v3.499h-2.5z" />
            </svg>
          </button>
          <button
            type="button"
            class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
          >
            <svg class="h-5 w-5 text-pink-600" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z" />
              <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" />
            </svg>
          </button>
          <button
            type="button"
            class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
          >
            <svg class="h-5 w-5 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M22.54 10.843c.14-.67.16-1.356.1-.206-.04-.86-.26-1.71-.62-2.52-.48-.99-1.16-1.85-2.02-2.54-.74-.61-1.58-1.08-2.48-1.4C16.14 4.04 14.07 3.5 12 3.5c-2.07 0-4.14.54-6.05.97-1.9.43-3.69 1.09-5.34 1.94-.9.47-1.74 1.07-2.5 1.78-.76.71-1.38 1.52-1.86 2.4-.48.88-.74 1.8-.8 2.72-.08.93.02 1.86.32 2.77.3.91.79 1.76 1.44 2.52.65.75 1.43 1.37 2.32 1.85.89.48 1.84.83 2.81 1.04.97.21 1.96.31 2.95.31.67 0 1.34-.04 2.01-.11.67-.07 1.33-.19 1.98-.37.65-.17 1.28-.41 1.88-.71.6-.3.97-.7 1.23-1.22.26-.52.39-1.08.38-1.64 0-.17-.01-.34-.03-.51-.02-.17-.05-.34-.09-.5-.04-.16-.09-.32-.15-.47-.06-.15-.14-.29-.23-.43-.09-.14-.2-.27-.31-.39-.12-.13-.24-.24-.38-.35-.14-.11-.29-.21-.44-.3-.16-.09-.32-.16-.49-.23-.17-.07-.35-.12-.53-.16-.18-.04-.36-.07-.55-.09-.19-.02-.38-.03-.57-.03-.19 0-.38.01-.57.03-.19.02-.37.05-.55.09-.18.04-.35.09-.53.16-.18.07-.35.14-.51.23-.16.09-.31.19-.45.3-.14.11-.26.22-.38.35-.11.12-.21.24-.31.39-.1.15-.18.3-.24.46-.06.16-.1.32-.13.5-.03.18-.05.36-.05.54 0 .18.01.36.04.54.03.18.07.35.13.5.06.16.13.31.22.45.09.14.19.27.3.39.11.12.23.23.36.34.13.11.27.2.41.29.14.09.29.16.44.23.15.07.31.12.47.16.16.04.33.06.5.08.17.02.34.03.51.03.17 0 .34-.01.51-.03.17-.02.33-.05.49-.09.16-.04.31-.09.45-.16.14-.07.27-.15.39-.24.12-.09.23-.19.33-.3.1-.11.19-.23.27-.37.08-.14.14-.28.19-.43.05-.15.08-.3.1-.46.02-.16.03-.33.03-.5z" />
            </svg>
          </button>
        </div>

        <!-- Register Link -->
        <p class=" hidden text-center text-sm text-gray-600 mt-4">
          Don't have an account?
          <a href="/register" class="font-medium text-primary hover:text-primary-dark">Sign up</a>
        </p>
      </div>
    </div>

    <div class="relative">
        <div class="absolute inset-0 flex items-center px-10">
            <div class="w-full border-t-2 border-gray-300 "></div>
        </div>
    </div>

    <Footer/>
  </template>

