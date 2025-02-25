# 🚀 Getting Started  

No dependencies, no frameworks—just pure native PHP.  

## 📥 Installation  

1. **Clone the repository**  
2. **Set up a virtual host** for your local development environment  
3. **Create a database** (default: `blog`, or choose a different name)  
4. **Import the provided SQL file**  

## 📂 Project Structure  

📦 Project Root  
┣ 📂 assets`       // CSS, JS, and static image files`  
┣ 📂 config`       // Database configurations, routes, and middleware`  
┣ 📂 controllers `  // Main application controllers`  
┣ 📂 core`         // Core functionalities (Router, Models, Views, Middleware, Sessions, Helpers)`  
┣ 📂 middlewares `// Custom middleware implementations`    
┣ 📂 models`      // Application models`  
┣ 📂 uploads`     // Blog post images`  
┣ 📂 views`       // Frontend view files`  
┣ 📜 .htaccess`    // Redirects all requests to index.php`  
┗ 📜 index.php`   // Autoloads and initializes the session`  


## 🌍 Application Pages  

| Page               | URL                  | Description |
|--------------------|----------------------|-------------|
| **Homepage**       | `/`                   | Displays blog posts with infinite scrolling (20 posts per load) |
| **Blog Post**      | `/blog/{id}`          | Displays a single blog post |
| **Admin Login**    | `/admin`              | Admin login page |
| **Admin Dashboard**| `/dashboard`          | Admin panel to manage posts |

## 🔑 Credentials  

### Admin User  
📧 **Email:** `admin@admin.com`  
🔑 **Password:** `admin`  

### Regular User  
You can register a new user—no email verification is required.  






