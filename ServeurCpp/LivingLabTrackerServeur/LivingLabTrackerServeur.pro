QT += core
QT -= gui

CONFIG += c++11

TARGET = LivingLabTrackerServeur
CONFIG += console
CONFIG -= app_bundle

TEMPLATE = app

SOURCES += main.cpp \
    serveur.cpp

HEADERS += \
    serveur.h
