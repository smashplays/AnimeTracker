import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CalendarComponent } from './pages/calendar/calendar.component';
import { NotificationsComponent } from './pages/notifications/notifications.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { PasswordComponent } from './pages/password/password.component';
import { ConfigComponent } from './pages/config/config.component';
import { SharedModule } from '../shared/shared.module';



@NgModule({
  declarations: [
    CalendarComponent,
    NotificationsComponent,
    ProfileComponent,
    PasswordComponent,
    ConfigComponent
  ],
  exports: [
    CalendarComponent,
    NotificationsComponent,
    ProfileComponent,
    PasswordComponent,
    ConfigComponent
  ],
  imports: [
    CommonModule,
    SharedModule
  ]
})
export class UserModule { }
