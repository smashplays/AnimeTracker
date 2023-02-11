import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CalendarComponent } from './pages/calendar/calendar.component';
import { PetitionsComponent } from './pages/petitions/petitions.component';
import { NotificationsComponent } from './pages/notifications/notifications.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { PasswordComponent } from './pages/password/password.component';
import { ConfigComponent } from './pages/config/config.component';



@NgModule({
  declarations: [
    CalendarComponent,
    PetitionsComponent,
    NotificationsComponent,
    ProfileComponent,
    PasswordComponent,
    ConfigComponent
  ],
  exports: [
    CalendarComponent,
    PetitionsComponent,
    NotificationsComponent,
    ProfileComponent,
    PasswordComponent,
    ConfigComponent
  ],
  imports: [
    CommonModule
  ]
})
export class UserModule { }
