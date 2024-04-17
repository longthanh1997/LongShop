import os
import replicate
import random

os.environ["REPLICATE_API_TOKEN"] = "r8_An2N6jFmMJwu0DJEzh5n0ajKbAEDrVV1mmLY0"

prompts = [
    "How can AI be leveraged to enhance the user experience on an e-commerce website?",
    "What are some AI-powered features that can improve product recommendations on an e-commerce platform?",
    "How can AI be used to personalize the shopping experience for customers on an e-commerce website?",
    "What are the benefits of using AI for inventory management and supply chain optimization in e-commerce?",
    "How can AI be utilized for better customer support and chatbot interactions on an e-commerce website?",
    "How can AI be used for dynamic pricing and promotions on an e-commerce website?",
    "What are the advantages of using AI for analyzing customer behavior and purchase patterns in e-commerce?",
    "How can AI assist in optimizing search and navigation on an e-commerce website?",
    "What are some AI-powered tools for enhancing the checkout and payment processes on an e-commerce platform?",
    "How does Laravel's modular architecture and MVC pattern contribute to efficient e-commerce website coding?",
    "What are some popular Laravel packages and libraries that can be used for e-commerce website development?",
    "How does Laravel's built-in security features help in protecting e-commerce websites from vulnerabilities?",
    "What are the benefits of using Laravel's Eloquent ORM for managing e-commerce data and database operations?",
    "How does Laravel's routing system simplify the development of complex e-commerce website structures?",
    "What are some best practices for optimizing performance and scalability when building e-commerce websites with Laravel?",
    "How does Laravel's robust testing capabilities assist in ensuring the quality and reliability of e-commerce website code?",
    "What are some real-world examples of successful e-commerce websites built using the Laravel framework?",
    "What are the essential features that every e-commerce website should have?",
    "How can an e-commerce website be optimized for search engines (SEO) to drive more organic traffic?",
    "What are the best practices for ensuring a smooth and secure checkout process on an e-commerce website?",
    "How can an e-commerce website be made mobile-friendly and responsive for a better user experience on different devices?",
    "What are the key considerations for integrating various payment gateways and methods on an e-commerce platform?",
    "How can an e-commerce website leverage social media integration to increase sales and customer engagement?",
    "What are the strategies for improving website navigation and product categorization on an e-commerce platform?",
    "How can an e-commerce website be designed to provide a personalized shopping experience for returning customers?",
    "What are the best practices for implementing a robust and scalable shopping cart system on an e-commerce website?",
    "How can an e-commerce website be optimized for faster page load times and improved performance?",
    "What are the essential security measures that should be implemented on an e-commerce website to protect customer data and transactions?",
    "How can an e-commerce website leverage customer reviews and ratings to increase trust and sales?",
    "How can an e-commerce website be designed to comply with accessibility standards and guidelines?",
    "What are the best practices for managing and updating product catalogs and inventory on an e-commerce website?",
    "How can an e-commerce website be designed to provide a consistent and seamless experience across different platforms (web, mobile app, etc.)?"


]
chosen_prompt = random.choice(prompts)

output = replicate.run(
    "meta/llama-2-70b-chat:02e509c789964a7ea8736978a43525956ef40397be9033abf9fd2badfe68c9e3",
    input={
        "prompt": chosen_prompt
    }
)

# The meta/llama-2-70b-chat model can stream output as it's running.
# The predict method returns an iterator, and you can iterate over that output.
for item in output:
    # https://replicate.com/meta/llama-2-70b-chat/api#output-schema
    print(item, end="")
