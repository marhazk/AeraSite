/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RolePocketRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public GRolePocket value;
/*    */ 
/*    */   public RolePocketRes()
/*    */   {
/* 15 */     this.value = new GRolePocket();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.retcode);
/* 21 */     os.marshal(this.value);
/* 22 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 27 */     this.retcode = os.unmarshal_int();
/* 28 */     os.unmarshal(this.value);
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 36 */       RolePocketRes o = (RolePocketRes)super.clone();
/* 37 */       o.value = ((GRolePocket)this.value.clone());
/* 38 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 41 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RolePocketRes
 * JD-Core Version:    0.6.2
 */