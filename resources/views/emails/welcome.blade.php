<x-mail::message>
# Welcome to Inventory Management
{{-- {{ config('app.name') }} --}}

Hello {{ $user->name }},

Thank you for registering on our **Inventory Management System**. You can now manage your products, stock, and view reports seamlessly.

<x-mail::button :url="route('auth.showLogin')">
Login to Your Account
</x-mail::button>

**Important Notes:**
- You can **view products and transactions** but cannot make modifications.  
- If you need to **add, edit, or delete products or transactions**, please contact the **Admin** or **Inventory Staff**.  
- For any questions or issues, reach out to our support team.

Thanks,<br>
The Inventory Team
</x-mail::message>
