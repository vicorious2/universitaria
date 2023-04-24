import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateClaseComponent } from './create-clase.component';

describe('CreateClaseComponent', () => {
  let component: CreateClaseComponent;
  let fixture: ComponentFixture<CreateClaseComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CreateClaseComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CreateClaseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
