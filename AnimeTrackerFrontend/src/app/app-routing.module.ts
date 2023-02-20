import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/pages/login/login.component';
import { RegisterComponent } from './login/pages/register/register.component';
import { CalendarComponent } from './user/pages/calendar/calendar.component';
import { ConfigComponent } from './user/pages/config/config.component';
import { PasswordComponent } from './user/pages/password/password.component';
import { NotificationsComponent } from './user/pages/notifications/notifications.component';
import { PetitionsComponent } from './user/pages/petitions/petitions.component';
import { ProfileComponent } from './user/pages/profile/profile.component';
import { AddAnimeFormComponent } from './admin/pages/add-anime-form/add-anime-form.component';
import { AdminUsersComponent } from './admin/pages/admin-users/admin-users.component';
import { CharacterComponent } from './anime/pages/character/character.component';
import { InfoComponent } from './anime/pages/info/info.component';
import { PopularListComponent } from './anime/pages/popular-list/popular-list.component';
import { ProducerComponent } from './anime/pages/producer/producer.component';
import { ResultsComponent } from './anime/pages/results/results.component';
import { AuthGuard } from './auth.guard';

const routes: Routes = [
    {
        path: 'login',
        component: LoginComponent,
        pathMatch: 'full'
    },
    {
        path: 'register',
        component: RegisterComponent,
        
    },
    {
        path: 'calendar',
        component: CalendarComponent,
        canActivate:[AuthGuard]
        
    },
    {
        path: 'config',
        component: ConfigComponent,
        canActivate:[AuthGuard]
    },
    {
        path: 'config/password',
        component: PasswordComponent,
        canActivate:[AuthGuard]

    },
    {
        path: 'notifications',
        component: NotificationsComponent
    },
    {
        path: 'petitions',
        component: PetitionsComponent
    },
    {
        path: 'profile',
        component: ProfileComponent
    },
    {
        path: 'add-anime',
        component: AddAnimeFormComponent
    },
    {
        path: 'admin-users',
        component: AdminUsersComponent
    },
    {
        path: 'character/:id',
        component: CharacterComponent
    },
    {
        path: 'producer/:id',
        component: ProducerComponent
    },
    {
        path: 'anime/:id',
        component: InfoComponent
    },
    {
        path: 'popular',
        component: PopularListComponent,
        pathMatch: 'full',
        canActivate:[AuthGuard]
    },
    {
        path: 'search/:name',
        component: ResultsComponent
    },
    {
        path: '**',
        redirectTo: 'login'
    }
];

@NgModule({
    imports: [
        RouterModule.forRoot( routes )
    ],
    exports: [
        RouterModule
    ]
})
export class AppRoutingModule {}