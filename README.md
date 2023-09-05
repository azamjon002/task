## Foydalanish
```bash
php artisan migrate --seed
php artisan serve
 ```
Seeder sizga User Manager va Admin role yaratib beradi va ularga huddi shu tartib user ham yaratadi va ularga quyidagi tartibda permissionlar belgilaydi:
```python
Admin --- userlarni va tasklarni to'liq boshqara oladi;
Manager --- tasklarni barchasini koradi va ularni tahrirlaydi;
User --- tasklarni barchasini va alohida birini koradi, yaratadi;
```
# Registration
Web orqali ham api orqali ham yangi user account yaratilganda unga User role avtomat belgilanadi. Bu roleni siz Webga admin bo'lib kirib o'zgartirishingiz mumkin.

Login qilish uchun sizdan username va password soraladi
Api orqali registration
```python 
Register => [your_localhost/api/register]  =>method=POST
Login => [your_localhost/api/login]        =>method=POST
Logout => [your_localhost/api/logout]      =>method=POST
```
### Task
```bash
Index => [your_localhost/api/v1/tasks]       =>method=GET
Create => [your_localhost/api/v1/tasks]      =>method=POST
        name=>required,
        description=>required
        user_id=>required
Edit => [your_localhost/api/v1/tasks/{id}]   =>method=PUT
Show => [your_localhost/api/v1/tasks/{id}]   =>method=GET
Delete => [your_localhost/api/v1/tasks/{id}] =>method=DELETE
Name orqali qidiruv => [your_localhost/api/v1/tasks/search/{name}] =>method=GET
```
Agar sizda ushbu actionlarga permission yoq bo'lsa 403 FORBIDDEN buyrug'ini olasiz.
Bunda siz bajarmoqchi bo'lgan actionga permission berilgan user orqali login qilasiz va qaytarilgan access_token ni olib Bearer Tokenga qoyasiz va siz bajarmoqchi bo'lgan harakatni amalga oshirasiz.

!!! Ushbu harakatlarni web orqali ham bajarishingiz mumkin.

