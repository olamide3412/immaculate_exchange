<script setup>
import { ref } from 'vue'
import FaqItem from './FaqItem.vue'

// FAQ Data
const faqs = [
  {
    question: "What is Immaculate exchange into?",
    answer: "Immaculate exchange is a cryptocurrency exchange company that deals specifically in the buying and selling of crypto such as bitcoin, ethereum, dogecoin, litecoin, USDT, and so on."
  },
  {
    question: "Why do your rates change?",
    answer: "The only reason crypto rates change is due to price fluctuations known as volatility."
  },
  {
    question: "What are your business hours?",
    answer: "Immaculate exchange is open and available to trade 24/7. Monday to Sunday."
  },
  {
    question: "Do you trade on Instagram & X (formerly known as Twitter)?",
    answer: "We are available to tend to your inquiries across all our social media platforms and website."
  },
  {
    question: "How long would it take to trade with Immaculate exchange?",
    answer: "It takes a maximum of 10 minutes to trade with us, and you get your credit alert instantly."
  }
]
</script>

<template>
    <section class="bg-white py-16" data-aos="fade-up" data-aos-duration="800">
      <div class="container mx-auto px-4">
        <!-- Section Title -->
        <div class="text-center mb-12">
          <h3 class="text-3xl font-bold text-gray-800">Most Frequent Questions</h3>
          <div class="w-20 h-1 bg-primary mx-auto my-3"></div>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
          <!-- FAQ Accordion -->
          <div class="lg:w-1/2 space-y-4">
            <FaqItem v-for="(faq, index) in faqs" :key="index" :question="faq.question" :answer="faq.answer" />
          </div>

          <!-- Call to Action -->
          <div class="lg:w-1/2 bg-gray-50 text-gray-700 p-8 rounded-lg shadow-md">
            <h4 class="text-2xl font-semibold mb-4">Request a Call Back</h4>
            <p class="mb-2">Want to know more?</p>
            <p class="mb-2">Kindly give us a call now.</p>
            <p class="font-bold text-lg mb-6">Call: {{ $page.props.support.phone_formatted }}</p>
            <a
              href="/sell"
              target="_blank"
              class="inline-block bg-primary hover:bg-primary-dark text-white py-2 px-6 rounded transition-transform transform hover:scale-105"
            >
              Sell Your Bitcoin
            </a>
          </div>
        </div>
      </div>
    </section>
  </template>

