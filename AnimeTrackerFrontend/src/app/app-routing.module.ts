import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/pages/login/login.component';
import { RegisterComponent } from './login/pages/register/register.component';
import { CalendarComponent } from './user/pages/calendar/calendar.component';
import { ConfigComponent } from './user/pages/config/config.component';
import { PasswordComponent } from './user/pages/password/password.component';
import { NotificationsComponent } from './user/pages/notifications/notifications.component';
import { ProfileComponent } from './user/pages/profile/profile.component';
import { AdminUsersComponent } from './admin/pages/admin-users/admin-users.component';
import { CharacterComponent } from './anime/pages/character/character.component';
import { InfoComponent } from './anime/pages/info/info.component';
import { PopularListComponent } from './anime/pages/popular-list/popular-list.component';

const routes: Routes = [
    {
        path: '',
        component: LoginComponent,
        pathMatch: 'full'
    },
    {
        path: 'register',
        component: RegisterComponent
    },
    {
        path: 'calendar',
        component: CalendarComponent
    },
    {
        path: 'config',
        component: ConfigComponent
    },
    {
        path: 'config/password',
        component: PasswordComponent
    },
    {
        path: 'notifications',
        component: NotificationsComponent
    },
    {
        path: 'profile',
        component: ProfileComponent
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
        path: 'anime/:id',
        component: InfoComponent
    },
    {
        path: 'popular',
        component: PopularListComponent,
        pathMatch: 'full'
    },
    {
        path: '**',
        redirectTo: ''
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