Wichtige Befehle, die ich Bash gelernt habe:

docker compose exec app bash : Bash in den Container app öffnen

composer create-project --prefer-dist laravel/laravel book-review : neues Laravel projekt mit dem Namen "book-review"

sudo chown -R tobi:tobi book-review/

Im Container mit Laravel:
php artisan tinker : tinker ausführen
php artisan migrate : Migration ausführen
php artisan make:factory TaskFactory --model=Task : Erstellt eine Factory-Class "Task" ist hier der Object Name
php artisan db:seed : Seeder ausführen
php artisan migrate:refresh --seed : Datenbank auf initial + seeder ausführen
php artisan serve : Laravel Server starten
php artisan make:migration create_table_name : Migration erstellen
php artisan make:request TaskRequest : Request validation erstellen
php artisan make:controller BookController --resource : Book Resource Controller erstellen
php artisan make:provider AuthServiceProvider : AuthServiceProvider erstellen, für Policies und Gates
php artisan install:api // api files installieren
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" // Installiert / Migriert das Sanctum für User Auth
php artisan make:policy AttendeePolicy --model=Attendee  // Erstellt eine Policy für das Model Attendee. Policy ist eine Art von Gate, die für ein Model gilt.
php artisan queue:work --stop-when-empty // Arbeiter für die Queue starten, der stoppt, wenn keine Jobs mehr in der Queue sind
php artisan queue:work --tries=3 --timeout=60 // Arbeiter für die Queue starten, der 3 Versuche pro Job macht und 60 Sekunden Timeout hat
php artisan queue:work --daemon // Arbeiter für die Queue starten, der im Hintergrund läuft und nicht stoppt
php artisan queue:listen // Arbeiter für die Queue starten, der im Hintergrund läuft und nicht stoppt, aber bei jedem Job neu startet
php artisan queue:restart // Arbeiter für die Queue neu starten, damit neue Jobs angenommen werden
