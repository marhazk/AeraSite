/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class ClearStorehousePasswdArg extends Rpc.Data
/*    */ {
/*    */   public int roleid;
/*    */   public Octets rolename;
/*    */   public Octets reserved;
/*    */ 
/*    */   public ClearStorehousePasswdArg()
/*    */   {
/* 16 */     this.rolename = new Octets();
/* 17 */     this.reserved = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.roleid);
/* 23 */     os.marshal(this.rolename);
/* 24 */     os.marshal(this.reserved);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.roleid = os.unmarshal_int();
/* 31 */     os.unmarshal(this.rolename);
/* 32 */     os.unmarshal(this.reserved);
/* 33 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 40 */       ClearStorehousePasswdArg o = (ClearStorehousePasswdArg)super.clone();
/* 41 */       o.rolename = ((Octets)this.rolename.clone());
/* 42 */       o.reserved = ((Octets)this.reserved.clone());
/* 43 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 46 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ClearStorehousePasswdArg
 * JD-Core Version:    0.6.2
 */