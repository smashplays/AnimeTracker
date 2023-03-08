import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AnimeSearchComponent } from './anime-search/anime-search.component';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from '../app-routing.module';
import { NavBarComponent } from './nav-bar/nav-bar.component';

@NgModule({
  declarations: [AnimeSearchComponent, NavBarComponent],
  exports: [AnimeSearchComponent, NavBarComponent],
  imports: [CommonModule, FormsModule, AppRoutingModule],
})
export class SharedModule {}
