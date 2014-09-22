/*     */ package com.goldhuman.service;
/*     */ 
/*     */ import com.goldhuman.Common.Octets;
/*     */ import java.io.PrintStream;
/*     */ import java.lang.reflect.Field;
/*     */ import java.util.HashMap;
/*     */ 
/*     */ public class ObjectCreator
/*     */ {
/*     */   public static Object create(Object srcObj, Class dstClass)
/*     */   {
/*  71 */     if (srcObj == null)
/*  72 */       return null;
/*  73 */     Class srcClass = srcObj.getClass();
/*  74 */     if ((dstClass == null) || (dstClass.equals(srcClass)))
/*  75 */       return srcObj;
/*  76 */     Object dstObj = null;
/*     */     try {
/*  78 */       dstObj = dstClass.newInstance(); } catch (Exception ex) {
/*  79 */       return null;
/*     */     }
/*     */ 
/*     */     try
/*     */     {
/*  88 */       if ((srcClass.equals(Octets.class)) && (dstClass.equals(String.class)))
/*     */       {
/*  91 */         return ((Octets)srcObj).getString();
/*     */       }
/*  93 */       if ((dstClass.equals(Octets.class)) && (srcClass.equals(String.class)))
/*     */       {
/*  96 */         Octets tmpo = new Octets();
/*  97 */         tmpo.setString((String)srcObj);
/*  98 */         return tmpo;
/*     */       }
/* 100 */       if ((srcClass.equals(Octets.class)) && (dstClass.getName().equals("[B")))
/*     */       {
/* 103 */         return ((Octets)srcObj).getBytes();
/*     */       }
/* 105 */       if ((dstClass.equals(Octets.class)) && (srcClass.getName().equals("[B")))
/*     */       {
/* 108 */         return new Octets((byte[])srcObj);
/*     */       }
/*     */     }
/*     */     catch (Exception ex)
/*     */     {
/* 113 */       System.out.println("cast error");
/* 114 */       return null;
/*     */     }
/*     */ 
/* 119 */     Field[] fieldsSrc = srcClass.getFields();
/* 120 */     Field[] fieldsDst = dstClass.getFields();
/*     */ 
/* 122 */     HashMap map = new HashMap();
/*     */ 
/* 124 */     for (int i = 0; i < fieldsDst.length; i++)
/*     */     {
/* 126 */       map.put(fieldsDst[i].getName(), fieldsDst[i]);
/*     */     }
/*     */ 
/* 129 */     for (int i = 0; (i < fieldsSrc.length) && (!map.isEmpty()); i++)
/*     */     {
/* 131 */       Field fieldSrc = fieldsSrc[i];
/* 132 */       Field fieldDst = (Field)map.remove(fieldSrc.getName());
/* 133 */       if (fieldDst != null)
/*     */       {
/* 135 */         Class fclassSrc = fieldSrc.getType();
/* 136 */         Class fclassDst = fieldDst.getType();
/*     */         try {
/* 138 */           if (fclassSrc.equals(fclassDst))
/*     */           {
/* 140 */             String classname = fclassSrc.getName();
/*     */ 
/* 142 */             if (classname.equals("int"))
/*     */             {
/* 144 */               fieldDst.setInt(dstObj, fieldSrc.getInt(srcObj));
/*     */             }
/* 146 */             else if (classname.equals("long"))
/*     */             {
/* 148 */               fieldDst.setLong(dstObj, fieldSrc.getLong(srcObj));
/*     */             }
/* 150 */             else if (classname.equals("byte"))
/*     */             {
/* 152 */               fieldDst.setByte(dstObj, fieldSrc.getByte(srcObj));
/*     */             }
/* 154 */             else if (classname.equals("char"))
/*     */             {
/* 156 */               fieldDst.setChar(dstObj, fieldSrc.getChar(srcObj));
/*     */             }
/* 158 */             else if (classname.equals("boolean"))
/*     */             {
/* 160 */               fieldDst.setBoolean(dstObj, fieldSrc.getBoolean(srcObj));
/*     */             }
/* 162 */             else if (classname.equals("double"))
/*     */             {
/* 164 */               fieldDst.setDouble(dstObj, fieldSrc.getDouble(srcObj));
/*     */             }
/* 166 */             else if (classname.equals("float"))
/*     */             {
/* 168 */               fieldDst.setFloat(dstObj, fieldSrc.getFloat(srcObj));
/*     */             }
/*     */             else
/*     */             {
/* 172 */               fieldDst.set(dstObj, fieldSrc.get(srcObj));
/*     */             }
/*     */ 
/*     */           }
/*     */           else
/*     */           {
/* 182 */             Object tmpObj = fieldSrc.get(srcObj);
/* 183 */             if (tmpObj != null)
/*     */             {
/* 188 */               fieldDst.set(dstObj, create(tmpObj, fclassDst));
/*     */             }
/*     */           }
/*     */         }
/*     */         catch (Exception ex) {
/*     */         }
/*     */       }
/*     */     }
/* 196 */     return dstObj;
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     com.goldhuman.service.ObjectCreator
 * JD-Core Version:    0.6.2
 */